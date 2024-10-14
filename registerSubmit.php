<?php
include 'dbh.php';
$message = []; 

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone"]; 
    $password = $_POST["password"];
    $Repassword = $_POST["Repassword"];

   
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE userEmail = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'User already exists!';
    } else {
        if($password != $Repassword){
            $message[] = 'Confirm Password not matched!';
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $insert_query = "INSERT INTO users (userName, userEmail, userphoneNumber, userPassword) 
                             VALUES ('$name', '$email', '$phoneNumber', '$hashed_password')";

            if(mysqli_query($conn, $insert_query)){
                $message[] = 'Registered Successfully!';
                header('location:login.php');
            } else {
                $message[] = 'Registration Failed!';
            }
        }
    }
}

mysqli_close($conn);

?>