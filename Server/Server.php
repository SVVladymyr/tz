<?php
	
	require_once 'includes/API/SendData.php';
	
	if(isset($_GET['type']) && isset($_GET['hash']) && ($_GET['data']) && Token::exists($_GET['hash'])){
		$data = new SendData($_GET['data']);

		try {
			$type = SendDataFactory::sendData($_GET['type']);
			echo $data->send($type);
		}
		catch (Exception $e) {
			echo $e;
		}
	}

?>