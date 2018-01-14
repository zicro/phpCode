<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '891762551338-8lls6iaaur1kiumlbmjf4060epuf815l.apps.googleusercontent.com'; //Google client ID
$clientSecret = '-YxCLUS_nZl6VkF3hcbNfN8K'; //Google client secret
$redirectURL = 'http://localhost/phpcode/googleLogin/'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to xLion');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>