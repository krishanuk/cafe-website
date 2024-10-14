<?php

include 'dbh.php';
session_start();


 if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $name = $_POST["name"];
    $cmessage = $_POST["cmessage"];

    $insert_query = "INSERT INTO contact (userEmail, userName, userMessage) 
            VALUES ('$email','$name', '$cmessage')";

if(mysqli_query($conn, $insert_query)){
    $message[] = 'Message Send!';
    header('location:contactforum.php');
    exit(); 
} else {
    $message[] = 'Message Send Failed!';
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
    <title>Contact Us</title>
</head>
<body>

<?php include 'mainHeader.php'; ?>

<section class="contact">
    <div class="container-con">
        <h2>Contact Us</h2>
        <div class="contact-wrapper">
            <div class="contact-form">
                <h3>Send us a message</h3>
                <form  method="post">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <textarea input type="text" name="cmessage" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" name="submit">Send Message</button>
                </form>
            </div>
            <div class="contact-info">
                <h3>Contact Information</h3>
                <p><i class="fa fa-phone"></i>+94-3458 2262</p>
                <p><i class="fa fa-envelope"></i>gallerycafe@example.com</p>
                <p><i class="fa fa-map-marker"></i>No50 Nugegoda Main Street</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
