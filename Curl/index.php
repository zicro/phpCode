<?php
$url = "http://www.xlion.org/";

// initialise
$init = curl_init();

// Set options
# connect to server
curl_setopt($init, CURLOPT_URL, $url);
# Return result of connection
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
# return header of site $url
curl_setopt($init, CURLOPT_HEADER, true);

// execute
$output = curl_exec($init);
/**
here we start using data
*/
$info = curl_getinfo($init);

print_r($info);

// Close the cnx
curl_close($init);
?>
