<?php

include 'dbh.php';

session_start();

if(isset($_SESSION['user_email'])){
    $userEmail = $_SESSION['user_email'];
 }else{
    $userEmail = '';
    header('location: ../login.php');
    exit();
 };


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/homeStyle.css">
    <title>Order Details</title>
</head>
<body>


<?php include 'mainHeader.php' ?>   

<section class="order-details">
    <h1 class="title">Pre-Orders Details</h1>
    <div class="box-container">

    <?php  
    
    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE userEmail = '$userEmail'") or die('queary failed');

    if(mysqli_num_rows($order_query) > 0 ){

        while($fetch_orders = mysqli_fetch_assoc($order_query)){
    ?>

            <p>User Name : <span><?php echo $fetch_orders['userName']; ?></span></p>
            <p>User Phone Number : <span><?php echo $fetch_orders['userphoneNumber']; ?></span></p>
            <p>User Email : <span><?php echo $fetch_orders['userEmail']; ?></span></p>
            <p>Order Time : <span><?php echo $fetch_orders['ordertime']; ?></span></p>
            <p>Order Date : <span><?php echo $fetch_orders['orderdate']; ?></span></p>
            <p>Item Detals : <span><?php echo $fetch_orders['totalProducts']; ?></span></p>
            <p>Total Price :Rs <span><?php echo $fetch_orders['totalPrice']; ?></span></p>
            <p>Order Status : <span><?php echo $fetch_orders['status']; ?></span></p>

    <?php
        }
    }else{
        echo '<p class="empty-cart">No orders </p>';
    }

    ?>

    </div>
</section>

<section class="order-details">

    <h1 class="title">Reservation Details</h1>
    <div class="box-container">

    <?php  
        $reservation_query = mysqli_query($conn, "SELECT * FROM reservation WHERE userEmail = '$userEmail'") or die('query failed');

        if(mysqli_num_rows($reservation_query) > 0 ){

            while($fetch_reservation = mysqli_fetch_assoc($reservation_query)){
    ?>

            <p>User Name : <span><?php echo $fetch_reservation['userName']; ?></span></p>
            <p>User Phone Number : <span><?php echo $fetch_reservation['userphoneNumber']; ?></span></p>
            <p>User Email : <span><?php echo $fetch_reservation['userEmail']; ?></span></p>
            <p>Table Number : <span><?php echo $fetch_reservation['tableNumber']; ?></span></p>
            <p>Reservation Time : <span><?php echo $fetch_reservation['restime']; ?></span></p>
            <p>Reservation Date : <span><?php echo $fetch_reservation['resdate']; ?></span></p>
            <p>Reservation Ststus : <span><?php echo $fetch_reservation['status']; ?></span></p>

    <?php
            }
        } else {
            echo '<p class="empty-cart">No Reservation</p>';
        }
    ?>

    </div>

</section>



<?php include 'footer.php' ?>
</body>
</html>