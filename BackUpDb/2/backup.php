<?
// Inspired by tutorials: http://www.phpfreaks.com/tutorials/130/6.php
// http://www.vbulletin.com/forum/archive/index.php/t-113143.html
// http://hudzilla.org


// Create the mysql backup file
// edit this section
$dbhost = "sql113.eb2a.com"; // usually localhost
$dbuser = "eb2a_20653752"; //enter your database username here
$dbpass = "********"; //enter your database password here
$dbname = "eb2a_20653752_w894"; // enter your database name here
$sendto = "Send To <larhnimikit@gmail.com>";
$sendfrom = "Send From <larhnimikit@gmail.com>";
$sendsubject = "Daily Database Backup";
$bodyofemail = "Here is the daily backup of my database.";
// don't need to edit below this section

$backupfile = $dbname . date("Y-m-d") . '.sql.gz';
system("mysqldump -h $dbhost -u $dbuser --password=$dbpass $dbname | gzip > $backupfile");

// Mail the file


include('Mail.php');
include('Mail/mime.php');

$message = new Mail_mime();
$text = "$bodyofemail";
$message->setTXTBody($text);
$message->AddAttachment($backupfile);
$body = $message->get();
$extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
$headers = $message->headers($extraheaders);
$mail = Mail::factory("mail");
$mail->send("$sendto", $headers, $body);


// Delete the file from your server
unlink($backupfile);
?>
