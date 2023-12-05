<?php
require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;
$usersCollection = $db->users;

$cursor = $usersCollection->find();

foreach ($cursor as $document) {
    print_r($document);
}
?>
