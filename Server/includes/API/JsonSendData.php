<?php

	require_once 'InterfaceSendData.php';
	require_once 'SendData.php';
	
	Class JsonSendData implements InterfaceSendData{
		
		public function send(SendData $obj){
			if($obj->id && $obj->name){
				$array = array('data' => array('id' => $obj->id, 'name' => $obj->name,),); 
				return json_encode($array); 
			}
			
			return false;
		}

	}

	?>