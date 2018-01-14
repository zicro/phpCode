<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include_once 'src/twitteroauth.php';

/*
 * Configuration and setup Twitter API
 */
$consumerKey = 'L5yKYWDM96RZq1udSi1whMKFW';
$consumerSecret = 't82sbiFDpktA7mYjUPGxIHPOuUJwGCx624KF5VOs5O45G5ombQ';
$redirectURL = 'http://127.0.0.1/phpcode/twitterLogin/';

?>