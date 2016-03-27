<?php

require_once 'JsonSendData.php';
require_once 'XmlSendData.php';

class SendDataFactory { 

	public static function sendData($type) { 

		$type = $_GET['type'];
		// construct our class name and check its existence 
		$class = $type.'SendData'; 
		if(class_exists($class)) { 
			// return a new Writer object 
			return new $class(); 
		} 

		// otherwise we fail 
		
		throw new Exception('Unsupported format'); 
	} 

} 
?>