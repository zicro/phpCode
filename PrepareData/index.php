<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "test";

$db = new MySQLi($host, $dbUser, $dbPass, $dbName);

if (isset($_POST['link']) && $_POST['link'] != "" && $_POST['short'] != ""){
//Prepare
$link  = $_POST['link']; 
$short = $_POST['short'];

$query = $db->prepare("INSERT INTO shortlink(link,short) VALUES (?,?)");
//bind_param
/**
	i => integer
	d => double
	s => string
	b => blob
*/
$query->bind_param("ss",$link,$short);
//execute
$query->execute();
}
?>

<form method="post" action="index.php">
<input type="text" name="link" />
<input type="text" name="short" />
<input type="submit" />
</form>