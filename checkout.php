<?php
session_start();

// Require the Composer autoload for MongoDB
require 'vendor/autoload.php';

// Connect to your MongoDB database
$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->AIO;
$paymentsCollection = $database->payments;
$deliveriesCollection = $database->deliveries;

// Store address
$storeAddress = "15 University Ave, Wolfville, NS B4P 2R6";

// Redirect to cart if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}


function calculateEstimatedDeliveryTime($customerAddress, $storeAddress) {
    $addressDistanceMap = [
        "16 University Ave, Wolfville, NS B4P 2R6" => 5, 
        "17 University Ave, Wolfville, NS B4P 2R6" => 6, 
        "18 University Ave, Wolfville, NS B4P 2R6" => 7, 
        "19 University Ave, Wolfville, NS B4P 2R6" => 8, 
        "20 University Ave, Wolfville, NS B4P 2R6" => 8, 
        "10 University Ave, Wolfville, NS B4P 2R6" => 9, 
    ];

    $distance = $addressDistanceMap[$customerAddress] ?? 11; // Default to more than 10km if address not found

    if ($distance <= 5) {
        return "15 minutes";
    } elseif ($distance > 5 && $distance <= 10) {
        return "30 minutes";
    } else {
        return "1 hour";
    }
}

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture payment form data
    $paymentData = [
        'card_number' => $_POST['cardNumber'],
        'name_on_card' => $_POST['nameOnCard'],
        'expiry_date' => $_POST['expiryDate'],
        'security_code' => $_POST['securityCode'],
    ];

    // Capture delivery form data
    $deliveryData = [
        'customer_name' => $_POST['customerName'],
        'customer_address' => $_POST['customerAddress'],
        'customer_email' => $_POST['customerEmail'],
        'customer_phone' => $_POST['customerPhone'],
        // Pass store address to the function
        'estimated_delivery_time' => calculateEstimatedDeliveryTime($_POST['customerAddress'], $storeAddress),
    ];

    // Insert payment details into MongoDB
    $paymentResult = $paymentsCollection->insertOne($paymentData);

    // Insert delivery details into MongoDB
    $deliveryResult = $deliveriesCollection->insertOne($deliveryData);

    // Set a session variable to indicate the form has been submitted
    $_SESSION['form_submitted'] = true;

    // Redirect to a confirmation page or display a success message
    header('Location: success.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ALL IN ONE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* Updated background color */
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeInAnimation ease 3s; /* Added animation */
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadeInAnimation {
            0% {opacity: 0;}
            100% {opacity: 1;}
        }
        .card {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* Updated shadow */
            overflow: hidden;
            padding: 2rem;
        }
        h2, h3 {
            color: #333;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-section {
            background: #f8f9fa;
            margin-bottom: 1rem;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
        }
        .btn-custom {
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            padding: 10px 30px;
            color: white;
            font-size: 1.2rem;
            letter-spacing: 1.1px;
            box-shadow: 0 4px 6px rgba(92,184,92,0.4);
            transition: all 0.2s ease-in-out;
            display: block;
            width: 100%;
            text-align: center;
            background-image: linear-gradient(to right, #56ab2f, #a8e063); /* Gradient effect */
        }
        .btn-custom:hover {
            background-image: linear-gradient(to right, #4cae4c, #a2e076); /* Hover effect */
            box-shadow: 0 6px 10px rgba(76,174,76,0.4);
            transform: translateY(-2px);
        }
    
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            box-shadow: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(128,189,255,.25);
        }
        .card-input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #ced4da;
        }
        .card-detail-input {
            position: relative;
        }
        .payment-image, .customer-service-image {
            width: 100%;
    max-width: 300px; /* Adjust as needed */
    margin: 0 auto 20px;
    display: block;
    border-radius: 50%; /* Makes the image circular */
    animation: slideIn 1.5s ease-out;
    animation-delay: 0.5s; /* Adjust this value as needed */
    animation-fill-mode: forwards;
    }
    .payment-image, .customer-service-image, h3.animated-entry {
        animation-delay: 0.5s; /* Adjust this value as needed */
    }

    /* Ensure the headings also have the animation */
    h3.animated-entry {
        animation: slideIn 1.5s ease-out;
        animation-fill-mode: forwards; /* This ensures that the properties set at the end of the animation are retained at the end */
    }
        .animated-entry {
        animation: slideIn 1.5s ease-out;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(-30px);
            opacity: 0;
            visibility: hidden;
        }
        1% {
            visibility: visible;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="form-section">
            <h3 class="animated-entry"></h3>
                 <img src="credit.png" alt="Payment Details" class="payment-image">
                <div class="card-detail-input mb-3">
                    <input type="text" name="cardNumber" class="form-control" placeholder="Card number" required>
                    <i class="far fa-credit-card card-input-icon"></i>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="nameOnCard" class="form-control" placeholder="Name on card" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="expiryDate" class="form-control" placeholder="Expiry date" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="securityCode" class="form-control" placeholder="Security code" required>
                    </div>
                </div>
            </div>

           

            <div class="form-section">
            <h3 class="animated-entry"></h3>
                 <img src="human.png" alt="Customer Service" class="customer-service-image">
                <input type="text" name="customerName" class="form-control" placeholder="Your Full Name" required>
                <input type="text" name="customerAddress" class="form-control" placeholder="Delivery Address" required>
                <input type="email" name="customerEmail" class="form-control" placeholder="Email Address">
                <input type="tel" name="customerPhone" class="form-control" placeholder="Phone Number">
            </div>

            <button type="submit" class="btn btn-custom">Confirm and Pay</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(() => {
            document.querySelectorAll('.animated-entry').forEach((el) => {
                el.style.visibility = 'visible';
            });
        }, 10);
    });
</script>

</body>
</html>