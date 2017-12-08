<?php

# illiminer les balises HTML & PHP.
$a = strip_tags("<a>hola</a>");

# permet la verification si la variable contient une valeur.
if(isset($a)){
	
}

# afficher le code HTML mais ne pas l'activer (affichage seulement)
$b = htmlspecialchars('<a>URL test Balise ..</a>');

$b1 = htmlentities('<input type="submit"/>');

# permet d'ajouter des slashes en cas de (magic quotes = off)
## a pour but d'entrer les donnes en mode secure dans la bdd
$c = addslashes($b1);

# la function contraire d'addslashes,il permet d'eliminer les slashes,
## on l'utilise au moment d'affichage des donnes.

$d = stripslashes($c);

# Remplacer un mots par un autre
$list = array('dog','ann','chien','bitch','holas');
echo str_ireplace($list,"***","text in with will be Bitch remplaced dogs doged <br> ");


#String Functions
$text = "a test text For String Management <br>";

echo trim($text,"a"); // il existe aussi (ltrim,rtrim)
//il permet de ilinumer un mot ou une lettre dans une phrase qui se trouve au premier au a la fin d'une phrase


# implode and Explode function
$str = "i use Php and Mysql";
$ar = explode(" ",$str);


echo "<pre>";
print_r($ar);
echo "</pre>";

echo implode($ar," | ");



echo $b.' - '.$b1.'<br>'.$c;



?>