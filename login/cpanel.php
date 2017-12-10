<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['pass'])){
	header("Location:index.php");	
	
}

echo 'Welcome '.$_SESSION['name'].' To the Administration';
echo '<br> <a href="logout.php">LogOut..</a>';
?>