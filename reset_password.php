<?php
require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;
$usersCollection = $db->users;
$passwordResetsCollection = $db->password_resets;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    // Find the token in the database
    $record = $passwordResetsCollection->findOne(['token' => $token]);

    // Check if token has expired or not
    // ...

    if ($record) {
        // Token found, show the password reset form
        // You can add time-based logic to invalidate the token
    } else {
        echo "This password reset token is invalid.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // User submitted the password reset form
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    $record = $passwordResetsCollection->findOne(['token' => $token]);

    if ($record) {
        // Token found, reset the password
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $usersCollection->updateOne(
            ['email' => $record['email']],
            ['$set' => ['password' => $hashedPassword]]
        );

        // Remove the token from database as it's no longer needed
        $passwordResetsCollection->deleteOne(['token' => $token]);

        echo "Your password has been reset successfully.";
        // Redirect to the login page
    } else {
        echo "This password reset token is invalid.";
    }
}
?>

<!-- You will need a form where the user inputs their new password -->
