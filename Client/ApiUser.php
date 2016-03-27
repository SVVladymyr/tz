<?php
	
	Class ApiUser{
		public $server;
		public $port;
		
		/**
		*	Initialization 
		*	@param hostname and port
		*/
		public function __construct($paramServer, $paramPort){
			isset($paramServer)?  $this->server = $paramServer : $server = "localhost";
			isset($paramPort)?  $this->port = $paramPort : $port = 80;
		}
		
		/**
		*	Initialization 
		*	@param data, hash, type (xml or json)
		*	@return string
		*/
		public function getData($data, $hash, $type){
			error_reporting(0);
			$resp = file_get_contents('http://'.$this->server.':'.$this->port.'/server.php?data='.$data.'&hash='.$hash.'&type='.$type);
			if(!$resp)
				$resp = "Data not found";
			return $resp;
		}
	}
	
?>