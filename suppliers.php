<?php session_start(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Suppliers - Fast N Fresh</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { 
            background: linear-gradient(120deg, #E9F7EF, #A8E6CF); 
            font-family: 'Arial', sans-serif; 
        }
        .supplier { 
            margin-bottom: 50px; 
            border-radius: 15px; 
            background-color: #F9FFF3; 
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1); 
            padding: 20px; 
            transform: scale(1);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }
        .supplier img { 
            max-width: 100%; 
            width: 300px;
            height: 200px; 
            display: block; 
            margin: 0 auto; 
            border-radius: 10px; 
            transition: transform 0.5s ease;
        }
        .supplier:hover {
            transform: scale(1.05);
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.2);
        }
        .supplier:hover img {
            transform: rotate(5deg);
        }
        .supplier h3 { 
            color: #2E7D32; 
            margin-bottom: 10px; 
            text-align: center; 
        }
        .supplier p { 
            color: #333333; 
            text-align: justify; 
        }
        /* Animation and transition styles */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .supplier {
            animation: fadeIn 1s ease-out forwards;
        }
        .supplier:nth-child(1) {
            animation-delay: 0.5s;
        }
        .supplier:nth-child(2) {
            animation-delay: 1s;
        }
        .supplier:nth-child(3) {
            animation-delay: 1.5s;
        }
        /* Add a color overlay on hover */
        .supplier:hover {
            position: relative;
            z-index: 1;
        }
        .supplier:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            z-index: -1;
        }
        /* Flying animations for images */
        @keyframes flyInFromTopLeft {
            0% { transform: translate(-100vw, -100vh) scale(0); }
            100% { transform: translate(0, 0) scale(1); }
        }

        @keyframes flyInFromTopRight {
            0% { transform: translate(100vw, -100vh) scale(0); }
            100% { transform: translate(0, 0) scale(1); }
        }

        @keyframes flyInFromBottom {
            0% { transform: translate(0, 100vh) scale(0); }
            100% { transform: translate(0, 0) scale(1); }
        }

        .supplier:nth-child(1) img {
            animation: flyInFromTopLeft 1s ease-out forwards;
        }

        .supplier:nth-child(2) img {
            animation: flyInFromTopRight 1s ease-out forwards;
        }

        .supplier:nth-child(3) img {
            animation: flyInFromBottom 1s ease-out forwards;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-5 text-center" style="color: #2E8B57; font-weight: bold; text-shadow: 1px 1px 2px #999;">Our Esteemed Suppliers</h1>
        <div class="row">
            <div class="col-md-4 supplier">
                <img src="https://cdn.mos.cms.futurecdn.net/5StAbRHLA4ZdyzQZVivm2c.jpg" alt="Walmart logo">
                <h3>Walmart</h3>
                <p>As a pivotal partner, Walmart endows us with a diverse range of premium products at competitive prices. Their unwavering commitment to eco-friendly initiatives ensures that our customers not only receive superior quality items but also contribute positively to environmental preservation.</p>
            </div>
            <div class="col-md-4 supplier">
                <img src="https://m.media-amazon.com/images/G/01/gc/designs/livepreview/amazon_dkblue_noto_email_v2016_us-main._CB468775011_.png" alt="Amazon logo">
                <h3>Amazon</h3>
                <p>Amazon, a global e-commerce leader, provides us with an extensive array of products, from everyday essentials to unique finds. Their advanced logistics network ensures timely and reliable delivery, enhancing our ability to offer a wide selection of goods to our customers with exceptional convenience.</p>
            </div>
            <div class="col-md-4 supplier">
                <img src="https://dessertadvisor.com/wp-content/uploads/2020/07/240dd90898766a949e7df3961cadc702.png" alt="Atlantic Superstore logo">
                <h3>Atlantic Superstore</h3>
                <p>Renowned in Canada, Atlantic Superstore is synonymous with fresh, indigenous, and top-tier products. Our collaboration with them augments the value we offer to our clientele. Their emphasis on bolstering local suppliers enables us to introduce our customers to a diverse palette of regional delicacies.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>