<?php
	require_once 'config.php';

	if(isset($_GET['tkn'])){

		// Is this a valid login token?
		$user = User::findByToken($_GET['tkn']);

		if($user){

			// Yes! Login the user and redirect to the protected page.
			$user->set('registered',true);
			$user->set('token',null);
			redirect('../../index.php');
		}

		// Invalid token. Redirect back to the login form.
		User::deleteUser($_GET['tkn']);
		redirect('../../index.php');
	}

/*--------------------------------------------------
	Handle submitting the Registation form via AJAX
---------------------------------------------------*/
	
	if ($_FILES){
		$uploadfile = __DIR__ . '/assets/photo/' . basename($_FILES['files']['name']);
		move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile);
		$photo = basename(($_FILES['files']['name']));	
	}
	else{
		$photo = null;
	}
try{	
	$name = htmlspecialchars(trim($_POST['name']));
	$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$password = htmlspecialchars(trim($_POST['password']));
	
	if(!empty($name) && !empty($email) && !empty($password)){
		$message = '';
		$subject = 'Your Login Link';
		
		if(!User::exists($email)){
			$subject = "Thank You For Registering!";
			$message = "Thank you for registering at our site!\n\n";
		}

		// Attempt to login or register the person
		$user = User::loginOrRegister($name, $password, $email, $photo);


		$message.= "You can login from this URL:\n";
		$message.= get_page_url()."?tkn=" . $user->token . "\n\n";

		$message.= "The link is going expire automatically after 1 hour.";

		$result = send_email($fromEmail, $email, $subject, $message);

		if($result){
			echo true;
		}
		else echo false;
	}
}
catch(Exception $e){ }
?>