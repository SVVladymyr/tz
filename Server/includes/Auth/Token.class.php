<?php

class Token{

	// Private ORM instance
	private $tokORM;

    /**
     * Create a new user object
     * @param $param ORM instance, id, email or null
     * @return User
     */

    public function __construct($param = null){
	
    	if($param instanceof ORM){

    		// An ORM instance was passed
    		$this->tokORM = $param;
    	}
    	else if(is_string($param)){

    		// An email was passed
    		$this->tokORM = ORM::for_table('reg_login_attempt')
    						->where('hash', $param)
    						->find_one();
    	}
    }


	/**
	 * Find a user by a token string. Only valid tokens are taken into
	 * consideration. A token is valid for 10 minutes after it has been generated.
	 * @param string $token The token to search for
	 * @return User
	 */

	public static function findByToken($hash){
		
		// find it in the database and make sure the timestamp is correct

		$result = ORM::for_table('reg_login_attempt')
						->where('hash', $hash)
						->where_raw('ts > NOW()')
						->find_one();

		if(!$result){
			return false;
		}

		return new User($result);
	}
	
	/**
	 * Login this user
	 * @return void
	 */

	public function login($email, $hashApi){

	// Mark the user as logged in
		$this->create($email, $hashApi);
	}

	/**
	 * Check whether the user is logged in.
	 * @return boolean
	 */

	public function loggedIn(){

		return (isset($_SESSION['sid'])) && (ORM::for_table('reg_users')->find_one($_SESSION['sid']));
	}
		
	/**
	 * Create a new user and save it to the database
	 * @param string parametr user's
	 * @return User
	 */

	private static function create($email, $hash){

		
		$result = (ORM::for_table('reg_login_attempt')->where('email', $email)->where_raw('ts > NOW()')->find_one());
		
		if(!$result){
			$result = ORM::for_table('reg_login_attempt')->create();
			$result->hash = $hash;
			$result->email = $email;
			$result->set_expr('ts', "ADDTIME(NOW(),'1:00')");
			$result->save();
			
			return new Token($result);
		}	
		else{
			$result->hash = $hash;
			$result->set_expr('ts', "ADDTIME(NOW(),'1:00')");
			$result->save();
			
			return $result->hash;	
		}
	}
	
	/**
	 * Check whether such a user exists in the database and return a boolean.
	 * @param string $email The user's email address
	 * @return boolean
	 */

	public static function exists($hash){

		// Does the user exist in the database?
		$result = ORM::for_table('reg_login_attempt')
					->where('hash', $hash)
					->where_raw('ts > NOW()')
					->count();

		return $result == 1;
	}
}