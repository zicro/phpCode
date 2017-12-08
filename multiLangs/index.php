<?php

$echolang = $_COOKIE['namelang'];

if (isset($echolang))
	include "$echolang.php";
else
	include "ar.php";


if (isset ($_POST['submit'])){
	
	$name = $_POST['lang'];
	
	switch($name){
		case "en":
		setcookie("namelang",$name,time()+555558);
		break;
		
		case "ar":
		setcookie("namelang",$name,time()+555558);
		break;
	}
	
	header("Refresh:0");
}




?>

<form action="index.php" method="post">
<select name="lang">
	<option value="en">English</option>
	<option value="ar">Arabic</option>
</select>
<input type="submit" name="submit" value="<?=$sub;?>" />
</form>
<br>
<table dir="<?=$dir;?>" width='80%'>
<tr>
<td><?=$body;?></td>
</tr>
</table>