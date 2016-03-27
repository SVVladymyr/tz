<?php

// To protect any php page on your site, include main.php
// and create a new User object. It's that simple!

require_once 'includes/Auth/config.php';

$user = new Token();
if(!$user->loggedIn()){
	redirect('index.php');
}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Protected page</title>

		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />
		
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!-- JSGrid -->
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/ui-lightness/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/ui.jqgrid.css" />
		
		<script src="assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
		<script src="assets/js/i18n/grid.locale-en.js" type="text/javascript"></script>
		<script src="assets/js/jquery.jqGrid.min.js" type="text/javascript"></script>
		<script src="assets/js/jsgrid.js" type="text/javascript"></script> 
	</head>

	<body>

		<div id="page">
			<div id="grid">
				<table id="list"></table>
				<div id="pager"></div>
				
				<a href="index.php?logout=1" class="logout-button">Logout</a>
			</div>
		</div>

	</body>
</html>