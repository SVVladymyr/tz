<?php 
  session_start(); 

  if($_POST['secret'] == $_SESSION['secret']) 
  { 
	$_SESSION['secret'] = null;
    echo "true";
  } 
  else 
  { 
    echo "false"; 
  } 
