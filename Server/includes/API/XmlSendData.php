<?php

	require_once 'InterfaceSendData.php';
	require_once 'SendData.php';
	
	Class XmlSendData implements InterfaceSendData{
		
		public function send(SendData $obj){
			if($obj->id && $obj->name){
				$s = '<?xml version="1.0" encoding="UTF-8"?>';
				$s .= '<data>'; 
				$s .= '<id>' . $obj->id . '</id>'; 
				$s .= '<name>' . $obj->name . '</name>'; 
				$s .= '</data>'; 
				return $s; 
			}
			
			return false;
		}

	}

?>