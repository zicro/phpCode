<?php
require_once "vendor/autoload.php";

$client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('eebd9e90', '9fae1954d40f6eb1'));

$message = $client->message()->send([
    'to' => 'Phone_Number',
    'from' => 'xLion',
    'text' => 'Test message from the Nexmo PHP Client'
]);

echo "Sent message to " . $message['to'] . ". Balance is now " . $message['remaining-balance'] . PHP_EOL;

// WebSite Used (nexmo.com)
#Required : Composer, account in nexmo (free account for test)