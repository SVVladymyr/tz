<?php
			session_id($_GET['sid']); 
			session_start();
			// ������� ��������: 
			$im = imagecreate(80,31); 

			// ����� ��� ���... 
			imageColorAllocate($im,246,246,246); 
			
			// ... � �����: 
			$textcolor = imageColorAllocate($im,0,0,255); 
			
			// ... ������� 
			$line = imageColorAllocate($im,255,0,0);
			imagestring($im,20,20,10,$_SESSION['secret'],$textcolor); 
			
			// ... � �������� �������, 
			// ������� �������� ������ "�������������" <p></p>
			// �������� � �������������� ������ 
			$line = imageColorAllocate($im,255,0,0);
			imageline($im,20,0,80,31,$line); 
			imageline($im,0,10,50,0,$line); 
			imageline($im,90,5,40,31,$line); 
			imageline($im,0,31,70,0,$line); 
			// ������� ����������� � �������
			
			imageGif($im); 
			header("Content-Type: image/gif");