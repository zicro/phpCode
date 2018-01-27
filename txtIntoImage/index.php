<?php
 
//Carregar imagem
$rImg = ImageCreateFromJPEG("dd.jpg");
 
//Definir cor
$cor = imagecolorallocate($rImg, 255, 255, 0);
 
//Escrever nome
imagestring($rImg,44,6,300,urldecode("Omarooooooooooooooooo"),$cor);
 
//Header e output
header('Content-type: image/jpeg');
imagejpeg($rImg,"img/Omarooooooooooooooooo_l1.jpg",100);
 
?>