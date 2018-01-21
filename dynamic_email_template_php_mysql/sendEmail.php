<?php
//Include database configuration file
require_once 'dbConfig.php';

/*
 * Contact email with template
 */

//get user details
$userName  = 'John Doe';
$userEmail = 'john@example.com';

//get email template data from database
$query = $db->query("SELECT * FROM email_templates WHERE type = 'contact_us'");
$tempData = $query->fetch_assoc();

//replace template var with value
$token = array(
    'SITE_URL'  => 'http://www.codexworld.com',
    'SITE_NAME' => 'CodexWorld',
    'USER_NAME' => $userName,
    'USER_EMAIL'=> $userEmail
);
$pattern = '[%s]';
foreach($token as $key=>$val){
    $varMap[sprintf($pattern,$key)] = $val;
}

$emailContent = strtr($tempData['content'],$varMap);

//send email to user
$to = $userEmail;
$subject = "Contact us email with template";

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: CodexWorld<sender@example.com>' . "\r\n";

// Send email
if(mail($to,$subject,$emailContent,$headers)):
    $successMsg = 'Email has sent successfully.';
else:
    $errorMsg = 'Email sending fail.';
endif;