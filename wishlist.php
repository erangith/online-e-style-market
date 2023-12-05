<?php
// MongoDB connection setup
require 'vendor/autoload.php'; // Make sure this points to the Composer autoload file

$client = new MongoDB\Client("mongodb://localhost:27017"); // Replace with your actual MongoDB connection string
$collection = $client->AIO->groceries_items;

// Fetching data from the database
$wishlistItems = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Wishlist</title>
    <!-- Add your CSS stylesheets here -->
</head>
<body>

<h1>Your Wishlist</h1>

<div id="wishlist-container">
    <?php foreach ($wishlistItems as $item): ?>
        <div class="wishlist-item">
            <h2><?= htmlspecialchars($item['name']) ?></h2>
            <p>Price: <?= isset($item['price']) ? htmlspecialchars($item['price']) : 'Price not available' ?></p>
            <p>Description: <?= htmlspecialchars($item['description'] ?? 'No description available') ?></p>
            <p>Store: <?= htmlspecialchars($item['store'] ?? 'Store unknown') ?></p>
            <form method="post" action="remove_from_wishlist.php"> <!-- Replace with your actual script to handle item removal -->
                <input type="hidden" name="item_id" value="<?= htmlspecialchars((string)$item['_id']) ?>" />
                <input type="submit" value="Remove from Wishlist" />
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
