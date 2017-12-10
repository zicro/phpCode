<?php
ob_start();
session_start();


if (isset($_SESSION['name']))
	header("Location:cpanel.php");
?>

<form action="check.php" method="post">
	<input type="text" name="user" />
	<input type="password" name="pass" />
	<input type="submit" name="login" />
</form>

<?php
ob_end_flush();
?>