<?php

require_once 'includes/Auth/config.php';


/*--------------------------------------------------
	Handle logging out of the system. The logout
	link in protected.php leads here.
---------------------------------------------------*/


if(isset($_GET['logout'])){

	$user = new Token();

	if($user->loggedIn()){
		unset($_SESSION['sid']);
	}
	redirect('index.php');
}


/*--------------------------------------------------
	Don't show the login page to already 
	logged-in users.
---------------------------------------------------*/


$user = new Token();

if($user->loggedIn()){
	redirect('protected.php');
}

/*--------------------------------------------------
	Output the login form
---------------------------------------------------*/

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Login form</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<form id="login" method="post" action="index.php">

			<h1>Login</h1>

			<label for="name">Name:</label>
			<input type="text" placeholder="Login name" id="name" autofocus  />
			<label for="password">Password:</label>
			<input type="password" placeholder="password" id="password" />
			<input type="checkbox" id="sendToken" value="sendToken" /> Send token to email</br>
			<button id="loginButton" type="submit">Login</button>
			<button id="registerButton" type="submit">Register</button>
			<span></span>

		</form>
        
		<!-- JavaScript Includes -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="assets/js/script.js"></script>

	</body>
</html>