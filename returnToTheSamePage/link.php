<?php

if (isset($_POST['submit'])){
	
	$url = $_GET['page'];
	
	//header("Location:".$url);
	echo "You are log In";
	echo "<meta http-equiv='refresh' content='3,".$url."'/>";
	exit(); // permet d'annuler l'ecexution du code au dessous 
	// le form ne va pas etre afficher.
}
?>
<form action="" method="post">
<input type="text" name="username"/>
<input type="text" name="password"/>
<input type="submit" name="submit"/>
</form>