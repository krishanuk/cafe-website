<?php

include 'dbh.php';

session_start();

if(isset($_SESSION['user_email'])){
    $userEmail = $_SESSION['user_email'];
 }else{
    $userEmail = '';
    header('location: login.php');
    exit();
 };

 if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    $cart_total = 0;
    $cart_products[] = '';

    $cart_queary = mysqli_query($conn, "SELECT * FROM cart WHERE userEmail= '$userEmail'") or die('queary failed');
    if(mysqli_num_rows($cart_queary)> 0){
        while($cart_item = mysqli_fetch_assoc($cart_queary)){
            $cart_products[] = $cart_item['Names'] . '('.$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_product = implode(', ', $cart_products);
    

    $order_query = mysqli_query($conn, "SELECT * FROM orders 
    WHERE userName='$name' AND userphoneNumber='$phone' AND userEmail='$email' 
    AND ordertime='$time' AND orderdate='$date' AND totalProducts='$total_product' AND totalPrice='$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'Your cart is Empty';
    }else{
        if(mysqli_num_rows($order_query) > 0){
            $message[] = 'order already added!';
        }else{
            mysqli_query($conn,"INSERT INTO orders(userName, userphoneNumber, userEmail, ordertime, orderdate, totalProducts, totalPrice)
            VALUES('$name', '$phone', '$email', '$time', '$date', '$total_product', '$cart_total')") or die('query failed');
            
            $message[] = 'Order placed Successfull';
        }
    }
 }



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/homeStyle.css">
    <title>Confirme Order</title>
</head>
<body>
    
<?php include 'mainHeader.php' ?>

<section class="confirme-content">

<section class="confirme-order">

<?php 

    $grand_total=0;

    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE userEmail= '$userEmail' ") or die('queary failed');


    if(mysqli_num_rows($select_cart) > 0){
        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
        
?>

<p><?php echo $fetch_cart['Names']; ?> <span>(<?php echo '$'. $fetch_cart['price'] .' x '. $fetch_cart['quantity']; ?>)</span></p>

<?php
    }
}else{
    echo '<p class="empty-cart">Cart is Empty</p>';
}
?>

<div class="grand-total">Total Price : $<?php echo $grand_total ?>/-</div>

</section>

<section class="confirme">

    <form action="" method="post">
        <h3>Confirme Youre Order</h3>
        <div class="flex">
            <div class="inputBox">
            <label for="name">User Name:</label>
                <input type="text" name="name" required placeholder="Enter Youre Name">
            </div>

            <div class="inputBox">
            <label for="phone">Contact Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your Phone Number Here" required pattern="[0-9]{10}">
            </div>

            <div class="inputBox">
            <label for="email">User Email:</label>
                <input type="email" name="email" required placeholder="Enter Youre Email">
            </div>
            
            <div class="inputBox">
            <label for="time">Arrival Time:</label>
                <input type="time" name="time" required placeholder="Enter Arrival Time">
            </div>

            <div class="inputBox">
            <label for="date">Arrival date:</label>
                <input type="date" name="date" required placeholder="Enter Arrival Time">
            </div>

            <div class="btnsub">
            <button type="submit" name="submit" >Confirme Order</button>
        </div>
        </div>
    </form>

</section>
</section>


<?php include 'footer.php' ?>

</body>
</html>