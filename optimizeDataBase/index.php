<?php

$db = new MySQLi("localhost","root","root","test");

	if($db->connect_errno >0){
	echo 'Error Connect Database';
	}
	
	$dbTables = $db->query("show tables");
	
	if($dbTables == true){
		while($report = $dbTables->fetch_array()){
			$db->query("repair table".&report[0]);
			$db->query("optimize table".&report[0]);
		}
	}
?>