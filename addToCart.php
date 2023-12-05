<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = [
        'id' => $_POST['itemId'],
        'name' => $_POST['itemName'],
        'price' => $_POST['itemPrice'],
        'quantity' => 1 // Future functionality could increase this
    ];

    // Check if the item already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$existingItem) {
        if ($existingItem['id'] === $item['id']) {
            $existingItem['quantity'] += 1; // Increase the quantity
            $found = true;
            break;
        }
    }
    if (!$found) {
        // Add item to cart if not found
        $_SESSION['cart'][] = $item;
    }

    // Set a session message for confirmation
    $_SESSION['message'] = "{$item['name']} added to cart.";

    // Redirect back to shopping page
    header("Location: products.php");
    exit();
}
?>
