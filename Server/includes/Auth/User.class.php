<?php

class User{

	// Private ORM instance
	private $orm;

    /**
     * Create a new user object
     * @param $param ORM instance, id, email or null
     * @return User
     */

    public function __construct($param = null){

    	if($param instanceof ORM){

    		// An ORM instance was passed
    		$this->orm = $param;
    	}
    	else if(is_string($param)){

    		// An email was passed
    		$this->orm = ORM::for_table('reg_users')
    						->where('email', $param)
    						->find_one();
    	}
    	else{

    		$id = 0;

    		if(is_numeric($param)){
    			// A user id was passed as a parameter
    			$id = $param;
    		}
    		else if(isset($_SESSION['loginid'])){

    			// No user ID was passed, look into the sesion
    			$id = $_SESSION['loginid'];
    		}

    		$this->orm = ORM::for_table('reg_users')
    						->where('id', $id)
    						->find_one();
    	}

    }


	/**
	 * Find a user by a token string. Only valid tokens are taken into
	 * consideration. A token is valid for 10 minutes after it has been generated.
	 * @param string $token The token to search for
	 * @return User
	 */

	public static function findByToken($token){
		
		// find it in the database and make sure the timestamp is correct

		$result = ORM::for_table('reg_users')
						->where('token', $token)
						->where_raw('token_validity > NOW()')
						->find_one();

		if(!$result){
			return false;
		}

		return new User($result);
	}
	
	public static function findById($id){

		$result = ORM::for_table('reg_users')->find_one($id);
		if(!$result){
			return false;
		}
		return $result->name;
	}
	
	public static function findByName($name){

		$result = ORM::for_table('reg_users')
						->where('name', $name)
						->find_one();

		if(!$result){
			return false;
		}

		return $result->id;
	}


	/**
	 * Either login or register a user.
	 * @param string $email The user's email address
	 * @return User
	 */

	public static function loginOrRegister($name, $password, $email, $photo){

		// If such a user already exists, return it

		if(User::exists($email)){
			return new User($email);
		}
		
		// Otherwise, create it and return it

		return User::create($name, $password, $email, $photo);
	}

	/**
	 * Create a new user and save it to the database
	 * @param string parametr user's
	 * @return User
	 */

	private static function create($name, $password, $email, $photo){

		// Write a new user to the database and return it

		$result = ORM::for_table('reg_users')->create();
		$result->name = $name;
		$result->email = $email;
		$options = ['cost' => 12,];
        $result->password = password_hash($password, PASSWORD_DEFAULT, $options);
		$result->photo = $photo;

		// Get token
        $token = sha1($result->email.time().rand(0, 1000000));

		// Save the token to the database, 
		// and mark it as valid for the next 10 minutes only

		$result->token = $token;
		$result->set_expr('token_validity', "ADDTIME(NOW(),'1:00')");
		$result->save();

		return new User($result);
	}

	/**
	 * Check whether such a user exists in the database and return a boolean.
	 * @param string $email The user's email address
	 * @return boolean
	 */

	public static function exists($email){

		// Does the user exist in the database?
		$result = ORM::for_table('reg_users')
					->where('email', $email)
					->count();

		return $result == 1;
	}

	/**
	 * Magic method for accessing the elements of the private
	 * $orm instance as properties of the user object
	 * @param string $key The accessed property's name 
	 * @return mixed
	 */

	public function __get($key){
		if(isset($this->orm->$key)){
			return $this->orm->$key;
		}
		return null;
	}
	
	/**
	 * Save one field to database.
	 * @return User
	 */
	public function set($key, $value){
		$this->orm->$key = $value;
		$this->orm->save();
		
		return $this->orm->$key;
	}
	
	/**
	 * Delete user by token.
	 * @return void
	 */
	public static function deleteUser($key){
		$result = ORM::for_table('reg_users')->where('token', $key)->find_one();
		if($result){
			$result->delete();
		}
	}
	
	/**
	 * Search by user to name.
	 * @return true -Array or false - boolean
	 */
	public function searchByKey($key){

		// Search by key
		$result = ORM::for_table('reg_users')->where('name', $key)->find_one();
		if($result){
			$arr = array("password" => $result->password, "registered" => $result->registered, "email" => $result->email, "id" => $result->id);
			return $arr;
		}
		return $result;
	}
}