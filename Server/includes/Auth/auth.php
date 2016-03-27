<?php
	require_once 'config.php';
	
	//Login
	$name = htmlspecialchars(trim($_POST['name']));
	$password = htmlspecialchars(trim($_POST['password']));
	$check = $_POST['sendToken'];
	if($name){
		if(verificationPassword($name, $password)){
			$hashApi = uniqid();
			$user = new User();
			$dataUser = $user->searchByKey($name);
			$_SESSION['sid'] = $dataUser["id"];
					
			if($check == "true"){
				$token = new Token();
				$token->login($dataUser["email"], $hashApi);
				$message = '';
				$subject = 'Your token';
				$message.= "Your token to access on API:\n";
				$message.= $hashApi. "\n";
				$message.= "The token is going expire automatically after 1 hour.";
				$result = send_email($fromEmail, $dataUser["email"], $subject, $message);

				if(!$result) echo false;
			}
			echo true;
		}
		else{
			echo false;
		}
	}
?>