<?php

	require_once 'includes/Auth/config.php';
	require_once 'InterfaceSendData.php';
	require_once 'SendDataFactory.php';
	
	Class SendData{
		
		public $id;
		public $name;

		public function  __construct($unknown) { 
			if(is_numeric($unknown)){
				$this->id = $unknown; 
				$this->name = User::findById($unknown); 
			}else{
				$this->name = $unknown; 
				$this->id = User::findByName($unknown);
			}
		}
		
		public function send(InterfaceSendData $obj){
			return $obj->send($this);
		}
	}

?>