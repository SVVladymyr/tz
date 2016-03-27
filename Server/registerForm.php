<?php
	session_start();
	  
	$alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
	$secret = "";	
	for($i=0;$i<5;$i++) 
		$secret = $secret.$alpha[rand(0,strlen($alpha)-1)]; 

	session_id(md5(microtime()*rand()));  
	$_SESSION['secret'] = $secret; 
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Registration form</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

		<!-- The main CSS file -->
		<link href="assets/css/register.css" rel="stylesheet" />

		<!--[if lt IE 10]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<form id="register" method="post" action="register.php"  enctype="multipart/form-data">

			<h1>Register</h1>

			<label for="name">Name:</label>
			<input type="text" required placeholder="Login name" id="name" autofocus  />
			
			<label for="password">Password:</label>
			<input type="password" required placeholder="password" id="password" />
			
			<label for="confirmpassword">Confirm password:</label>
			<input type="password" required placeholder="password" id="confirmpassword" />
			
			<label for="email">E-mail:</label>
			<input type="email" required placeholder="e-mail" id="email" />
			
			<label for="foto">Foto:</label>
			<input type="file" id="files" name="files[]" accept="image/jpeg,image/png,image/gif" />
			Type the characters from the image: <input type="text" id="secret" required>
			<img src="includes/Captcha/image.php?sid=<?=session_id();?>"> 
			<input type="submit" id="send">
			<span id="messageholder"></span>
		</form>
		
        
		<!-- JavaScript Includes -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
		<script src="assets/js/register.js"></script>
		

	</body>
</html>