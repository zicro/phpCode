<?php 
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","angularcrud");

$dbhandle=new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die("Unable to Connect DB");

?>
