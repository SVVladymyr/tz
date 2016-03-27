<?php

function send_email($from, $to, $subject, $message){

	// Helper function for sending email
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from . "\r\n";

	return mail($to, $subject, $message, $headers);
}

function get_page_url(){

	// Find out the URL of a PHP file

	$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'];

	if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != ''){
		$url.= $_SERVER['REQUEST_URI'];
	}
	else{
		$url.= $_SERVER['PATH_INFO'];
	}

	return $url;
}

function redirect($url){
	header("Location: $url");
	exit;
}

function verificationPassword($name, $password) {
	$user = new User();
	$hash = $user->searchByKey($name);
	if($hash){
		if($hash['password'] && $hash['registered']){
			if(password_verify($password, $hash['password'])){
				return true;	
			}
			return false;
		}
	}
	return false;	
}