<?php
			session_id($_GET['sid']); 
			session_start();
			// создаем картинку: 
			$im = imagecreate(80,31); 

			// серый фон фон... 
			imageColorAllocate($im,246,246,246); 
			
			// ... с синим: 
			$textcolor = imageColorAllocate($im,0,0,255); 
			
			// ... текстом 
			$line = imageColorAllocate($im,255,0,0);
			imagestring($im,20,20,10,$_SESSION['secret'],$textcolor); 
			
			// ... и красными линиями, 
			// которые усложнят задачу "распознавания" <p></p>
			// картинки в автоматическом режиме 
			$line = imageColorAllocate($im,255,0,0);
			imageline($im,20,0,80,31,$line); 
			imageline($im,0,10,50,0,$line); 
			imageline($im,90,5,40,31,$line); 
			imageline($im,0,31,70,0,$line); 
			// выводим изображение в браузер
			
			imageGif($im); 
			header("Content-Type: image/gif");