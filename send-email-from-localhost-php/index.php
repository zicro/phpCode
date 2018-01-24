<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'gmail adresse';          // SMTP username
$mail->Password = 'pass'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('from email', 'Omae Email');
$mail->addReplyTo('reply email', 'Arabic xLion');
$mail->addAddress('email');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>How to Send Email using PHP in Localhost by xLion</h1>';
$bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>xLion</b></p>';
$bodyContent .= '<p>Your database backup is <a href="http://xlion.eb2a.com/emailAttachement/db-backup.sql">here</a></p>';

$mail->Subject = 'Email from Localhost by xLion';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
