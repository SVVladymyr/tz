<?php

	// Подключаем класс для работы с API
	require_once 'ApiUser.php';
	
	// Инициализуруем класс
	$api = new ApiUser('localhost', 80);
	
	/**
	*	Получаем нужные данные
	*   @param (data, hash, type)
	*   @param	data - может быть идентификатор в базе или имя
	*   @param hash - хэш, полученный по электронной почте
	*   @param type - тип получаемых данных Json или XML
	*/
	echo $api->getData('vova', '56f7b5e8e43b4', 'xml');
	
?>