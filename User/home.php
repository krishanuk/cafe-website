<?php
session_start();
include 'dbh.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/homeStyle.css">
    <title>Home</title>
</head>
<body>
    <?php include 'mainHeader.php' ?>


    <section class="main">
        <div class="text-box">
            <h1>Welcome To The Gallery Cafe</h1>
            <p>Discover the charm of The Gallery Cafe in Colombo. Enjoy delicious meals, great coffee, </p>
            <p>and fine wines in a beautiful setting. Join us for special events and unforgettable experiences.</p>

               <div class="main-buttons">
               <a href="menu.php">Order Now</a>
               <a href="about.php">About Us</a>
               </div>
        </div>
    </section>

    <section class="promotion">
    <div class="text-box">
    <h2 class="promo">Our Promotions</h2>
    <img src="../imagesMain/promotion.jpg" alt="">
    </div>
    </section>



<section class="service">
    <h1>What We Offer</h1>
    <p>Where Art Meets Flavor - The Gallery Cafe</p>

    <div class="row">
        <div class="offer-col">
            <h3>Best Food</h3>
            <p>We are serves a variety of delicious dishes made with the finest ingredients. 
                Enjoy our hearty breakfasts, elegant lunches, and sumptuous dinners. Pair your meal with 
                freshly brewed coffee, a glass of wine, or a flight of beers. Each dining experience at 
                The Gallery Cafe combines taste, creativity, and luxury.</p>
        </div>

        <div class="offer-col">
            <h3>Special Events</h3>
            <p>Our Cafe is the perfect venue for your special occasions. Our beautifully designed
               space can accommodate up to 50 guests, with seating for 20 at our elegant tables. Whether 
               it’s a birthday celebration, corporate event, or an intimate gathering, we ensure an 
               unforgettable experience with our exceptional service and luxurious ambiance.</p>
        </div>

        <div class="offer-col">
            <h3>Pre-Order</h3>
            <p>Enhance your dining experience at The Gallery Cafe with our convenient pre-order food 
                and table reservation functions. Choose your favorite dishes in advance and have them 
                ready upon your arrival. Secure your spot by reserving a table ahead of time, ensuring 
                a seamless and stress-free visit to our luxurious setting.</p>
        </div>
    </div>
</section>

<section class="facilities">
<h1>Our Facilities</h1>
<p>Experience the epitome of hospitality with our attentive and dedicated staff,
     committed to ensuring every visit to The Gallery Cafe is memorable.</p>

     <div class="facilities-row">
        <div class="facilities-col">
            <img src="../imagesMain/park.jpg" alt="">
            <h3>Parking</h3>
            <p>Ample onsite parking for up to 20 vehicles ensures convenient access to The Gallery Cafr's luxurious dining experience.</p>
        </div>

        <div class="facilities-col">
            <img src="../imagesMain/diningarea.jpg" alt="">
            <h3>Elegant Dining Area</h3>
            <p>Stylish and comfortable seating for a luxurious dining experience.</p>
        </div>
        <div class="facilities-col">
            <img src="../imagesMain/privateevent.jpg" alt="">
            <h3>Private Event Space</h3>
            <p>Perfect for hosting special occasions with customizable settings.</p>
        </div>
     </div>
</section>



    <?php include 'footer.php' ?>
</body>
</html>