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
$message = []; 

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $phoneNumber = $_POST["phone"]; 
    $email = $_POST["email"];
    $tablenum = $_POST["tablenum"];
    $time = $_POST["restime"];
    $date = $_POST["resdate"];

    
    $select_reservations = mysqli_query($conn, "SELECT * FROM reservation 
        WHERE userEmail = '$email' AND restime = '$time' AND resdate ='$date'") or die('Query failed');

    if(mysqli_num_rows($select_reservations) > 0){
        $message[] = 'Reservation Already Added!';
    } else {
        
        $insert_query = "INSERT INTO reservation (userName, userphoneNumber, userEmail, tableNumber, restime, resdate) 
            VALUES ('$name', '$phoneNumber', '$email', '$tablenum', '$time', '$date')";

        if(mysqli_query($conn, $insert_query)){
            
            header('location:addReservation.php');
            exit(); 
            $message[] = 'Reservation Added Successfully!';
        } else {
            $message[] = 'Failed to Register!';
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
    <title>Add Reservation</title>
</head>
<body>

<?php include 'mainHeader.php'; ?>

<!-- Add Reservation Section Start -->
<section class="addreservation">
    <h1 class="title">Add Reservation</h1>
    <?php
if (!empty($message)) {
    echo '<div class="message-container">';
    echo '<ul>';
    foreach ($message as $msg) {
        echo '<li>' . htmlspecialchars($msg) . '</li>'; 
    }
    echo '</ul>';
    echo '</div>';
}
?>
    <div class="addreservation-container">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">User Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter Your Name" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your Phone Number Here" required pattern="[0-9]{10}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your Email Here" required>

        <label for="table">Table Number:</label>
        <input type="number" id="tablenum" name="tablenum" placeholder="Enter Table Number" required pattern="[0-9]{1,2}">

        <label for="time">Time:</label>
        <input type="time" id="restime" name="restime" placeholder="Enter Reserved Time" required>

        <label for="date">Date:</label>
        <input type="date" id="resdate" name="resdate" placeholder="Enter Reserved Date" required>

        <div class="btn">
            <button type="submit" name="submit" >Submit</button>
        </div>
    </form>
    </div>
</section>
<!-- Add Reservation Section Ending -->

        <?php include 'footer.php' ?>

</body>
</html>
