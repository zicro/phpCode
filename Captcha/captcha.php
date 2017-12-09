<?php
session_start();

# les chiffres qui vont etre afficher dans le captcha
// il sont generer d'une maniere aleatoire.
$text = rand(0000,9999);

# on stock la valeur generer aleatoirement
// dans la session a pour but de faire la comparaison.
$_SESSION['code'] = $text;

// la creation de l'image qui va contient le code captcha
$img = imagecreate(60,18);
# la color de fond (background) de l'image
$bg = imagecolorallocate($img,255,2555,2555);
# la color du chiffre
$font = imagecolorallocate($img,0,0,0);

# la creation de l'image
imagestring($img, 5, 12, 2, $text,$font);

# on choisie le format de l'image (png, jpeg ...)
imagepng($img);

?>