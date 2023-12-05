<?php
require 'vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://localhost:27017"); // replace with your actual MongoDB connection string
$db = $mongoClient->AIO; // replace with your actual database name

$searchText = $_GET['query'] ?? '';
$results = [];

if ($searchText !== '') {
    $searchText = preg_quote($searchText);
    $regex = new MongoDB\BSON\Regex('^'.$searchText, 'i');

    $collections = ['groceries', 'electronics', 'fashion', 'cosmetics']; // replace with your actual collection names

    foreach ($collections as $collectionName) {
        $collection = $db->$collectionName;
        $cursor = $collection->find(
            ['name' => $regex],
            ['limit' => 5, 'projection' => ['name' => 1, '_id' => 0]]
        );

        foreach ($cursor as $document) {
            $results[] = $document['name'];
        }
    }
}

header('Content-Type: application/json');
echo json_encode(array_values(array_unique($results)));
?>
