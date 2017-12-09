<?php

// connect Server informations
$host = "localhost";
$user = "root";
$pass = "root";

// establish connection
$con = mysql_connect($host,$user,$pass) or die (mysql_error());
// select Database
$db = mysql_select_db("test",$con) or die (mysql_error()); 
// prepare Query
$query = mysql_query("SELECT * FROM users");

echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>
<table border='3px'>
";
// execute Query and loop to show data
while($row = mysql_fetch_array($query)){
	echo "
	<tr>
	<td>".$row[0]."</td>
	<td>".$row[1]."</td>
	<td>".$row[2]."</td>
	<td><input type='checkbox' name='id[]' value='".$row[0]."'/></td>
</tr>";
}
echo "
</table>
<input type='submit' name='del' value='Delete Selected' />
</form>";

// the Procedure of Delete all Selected Data from The liste
if (isset($_POST['del'])){
	
	$id = $_POST['id'];
	if (empty($id) OR $id == 0){
		echo "Please Select rows to Del";
	}else{
		$delid = implode($id,",");
		$Delquery = "DELETE FROM users WHERE id in (".$delid.")";
		$dels	  = mysql_query($Delquery);
		if (isset($dels))
			echo "Deleted Success";
		
	}
	
	
}
?>