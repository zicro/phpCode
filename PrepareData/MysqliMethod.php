<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "test";

$db = new MySQLi($host, $dbUser, $dbPass, $dbName);



if (isset($_POST['valider'])){
	
	$link  = $db->real_escape_string($_POST['link']);
	$short = $db->real_escape_string($_POST['short']);

	$sql = "INSERT INTO shortlink(link,short) VALUES ('$link','$short')";
	$db->query($sql);
}
?>

<form method="post" action="index.php">
<input type="text" name="link" />
<input type="text" name="short" />
<input type="submit" name="valider" />
</form>