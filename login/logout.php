<?php
ob_start();
session_start();

if (!isset($_SESSION['name'])){
	header("Location:index.php");
}else{
	session_destroy();
	echo("You are loged Out<meta http-equiv='refresh' content='3;index.php' />");
}



ob_end_flush();
?>