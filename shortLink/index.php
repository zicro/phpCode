<?php

/**
Taf To Add
+ verifier si le lien est deja shortcuter, afficher le shortcuter
+ if shortcut demander redirectioner ver le lien cible depuis la BDD
+ verifier le lien entrer par l'utilisateur dans la input (Regex) in Js
*/

$con = mysql_connect("localhost","root","") or die(mysql_error);

$db = mysql_select_db("test",$con) or die("no Database Found");



//echo GetShortUrl();

if(isset($_POST['go'])){
	
$link  = $_POST['links'];
$short = GetShortUrl();
	
	$sql = "INSERT INTO  shortlink(link,short,status) VALUES ('".$link."','".$short."',1)";
	mysql_query($sql) or die(mysql_error);
	
#affichage du lien generer

$sql2 	= "SELECT short FROM shortlink ORDER BY id DESC";
$result = mysql_query($sql2) or die(mysql_error);

if($result){
	$show = mysql_fetch_array($result);
		echo "<label for='chk'>
	Your Short link is:
</label> <input id='chk' type='text' value='xlion.org/".$show[0]."' onfocus='this.select();' onclick='this.select();'>";
}

}

echo '
<form action="index.php" method="post">
<input type="text" name="links" />
<input type="submit" name="go" value="Short it .." />
</form>
';

function GetShortUrl(){
	#Get the code used to the URL
$code = rand(11111,99999);

$code   = str_replace(0,"a",$code); 
$code   = str_replace(1,"x",$code);
$code   = str_replace(2,"w",$code);
$code   = str_replace(3,"O",$code);
$code   = str_replace(4,"z",$code);
$code   = str_replace(5,"E",$code);
$code   = str_replace(6,"C",$code);
$code   = str_replace(7,"V",$code);
$code   = str_replace(8,"j",$code);
$code   = str_replace(9,"p",$code);

return $code;
}
?>