<?php

/**
DB Connect
*/
$connect = mysql_connect("localhost","root","") or die(mysql_error());
$db = mysql_select_db("test") or die(mysql_error());

/**
Get Data
*/
$time = time();
$ip = getenv('remote_addr');
$timeout = $time-60; // 60 = 1 min

/**
connect To the DB and manage Online Table
*/
$sql = mysql_query("DELETE FROM online where ip='$ip'");
$sql1 = mysql_query("DELETE FROM online where time<$timeout");
$sql2 = mysql_query("INSERT INTO online VALUES ('','$ip','$time')");
$sql3 = mysql_query("SELECT * FROM online");
$num = mysql_num_rows($sql3);
mysql_free_result($sql3);

/**
Show the number of visitor int the Site..
*/
echo $num;
?>