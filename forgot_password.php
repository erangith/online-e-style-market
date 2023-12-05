<?php
require 'vendor/autoload.php';

session_start();

// MongoDB client connection
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;
$passwordResetsCollection = $db->password_resets; // Collection to store password reset tokens

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Find the user by email
    $user = $db->users->findOne(['email' => $email]);

    if ($user) {
        // Generate a unique token - this should be stored securely
        $token = bin2hex(random_bytes(16));

        // Store the token in your database along with a timestamp
        $passwordResetsCollection->insertOne([
            'email' => $email,
            'token' => $token,
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ]);

        // TODO: Send the email with the token
        // Here you would use your email library to send the email

        $message = "If an account with that email exists, we have sent a reset link to it.";
    } else {
        $message = "If an account with that email exists, we have sent a reset link to it.";
        // It's a good idea not to give away whether an email is registered in the system
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add your stylesheet links here -->
</head>
<body>
    <!-- Style this section as needed -->
    <div>
        <h1>Forgot Password</h1>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form action="forgot_password.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
