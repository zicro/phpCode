<?php
session_start();
#Connection de Database
$con = mysql_connect("localhost","root","root");
$db	 = mysql_select_db("test",$con);


$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user && $pass){
	# Select information from the Database using the information entred by User
	$finduser = mysql_query("SELECT * FROM users 
		WHERE `name` = '".$user."' AND `pass` = '".$pass."' ") or die(mysql_error());
	$result   = mysql_fetch_array($finduser); 
	$data 	  = mysql_num_rows($finduser);
	
	if ($data != 0){
		echo 'Found User : '.$result[1];
		
		echo '<br><a href="cpanel.php">Go To Administration ...</a>';
		# Store informations in the Session
		$_SESSION['name'] = $result[1];
		$_SESSION['pass'] = $result[4];
	}else{
		die("Bad User Access <meta http-equiv='refresh' content='3;index.php' />");
	}
}else{
	die("Not Access Page  (Eror 404) <meta http-equiv='refresh' content='3;index.php' />");
}
ob_end_flush();
?>