<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "quiz";

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if($db->connect_error){
	
	printf("Connect Failed : %s\n", $db->connect_error);
	exit();
}

?>