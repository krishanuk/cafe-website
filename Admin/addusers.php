<?php

include 'dbh.php';
$message = []; 

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone"]; 
    $password = $_POST["password"];
    $Repassword = $_POST["Repassword"];
    $usertype = $_POST["usertype"];

 
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE userEmail = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exists!';
    } else {
        if($password != $Repassword){
            $message[] = 'Confirm Password not matched!';
        } else {
           
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $insert_query = "INSERT INTO users (userName, userEmail, userphoneNumber, userPassword, userType) 
                             VALUES ('$name', '$email', '$phoneNumber', '$hashed_password', '$usertype')";

            if(mysqli_query($conn, $insert_query)){
                $message[] = 'Registered Successfully!';
                header('location:addusers.php');
            } else {
                $message[] = 'Registration Failed!';
            }
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
    <link rel="stylesheet" href="../Style/adminStyle.css">
    <title>Add Users</title>
</head>
<body>
<?php include 'adminHeader.php';?>

            <!--Add Users Section Start -->

    <section class="addproducts" >

        <h1 class="title">Add Users</h1>

        <form action="" method="post">
               
                <label for="name">
                    Username:
                </label>
                <input type="text" id="name" name="name" placeholder="Enter User Name " required>

                <label for="email">
                    Email:
                </label>
                <input type="email" id="email" name="email" placeholder="Enter User Email " required>
                
                <label for="phoneNumber">
                    Phone Number:
                </label>
                <input type="phone" id="phone" name="phone" placeholder="Enter User Phone Number "  required pattern="[0-9]{10}">

                <label for="password">
                    Password:
                </label>
                <input type="password" id="password" name="password" placeholder="Enter Youre Password " required>

                <label for="Repassword">
                   Repeat Password:
                </label>
                <input type="password" id="Repassword" name="Repassword" placeholder="Confirm Youre Password " required>

                <label for="usertype">
                   User Type:(admin/staff)
                </label>
                <input type="text" id="usertype" name="usertype" placeholder="Enter User Type " required>

                <div class="btn">
                    <button type="submit" name="submit">Submit</button>
                </div>

            </form>
    </section>

     <!--Add Users Section End -->


</body>
</html>