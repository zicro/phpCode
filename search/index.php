<?php

## To d0
# Top Searchs
## search with latin words not including arabic words
### test and gere errors
#### if no result show msg
##### remove the white spaces
######
#######
########
#########
##########

$con 	  = mysql_connect('localhost','root','root') or die("Mysql Error");
$selectDb = mysql_select_db('test',$con) or die("No Database Selected");

$search   = mysql_real_escape_string($_GET['search']);



echo "<form action='index.php' method='get'>
Search Word : <input name='search' type='text' />
<input  value='Search ..' type='submit' />
<input  name='do' type='hidden' value='query' />
</form>";

if(empty($search)){
	echo "You Should Enter a Word To Search For it ...";
}else{
	if($_GET['do'] == 'query'){
		$Req = "SELECT * FROM users WHERE name like '%".$search."%' OR mail like '%".$search."%'";
		$Res = mysql_query($Req);
		
		
		echo "The Result :<hr><table border='2'><tr><th>id</th><th>name</th><th>email</th></tr>";
		while($data = mysql_fetch_array($Res)){
			echo "
				<tr>
				<td>".$data[0]."</td>
				<td>".$data[1]."</td>
				<td>".$data[2]."</td>
				</tr>";
			$Req2 = "UPDATE users SET nbrSearch = nbrSearch+1 WHERE id = $data[0]";
			$updt = mysql_query($Req2);
		}
		echo "</table>";
	}
}


?>