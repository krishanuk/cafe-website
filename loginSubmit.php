<?php 
session_start();

include 'dbh.php';

if(!$conn) {
    die("Connection Failed :" . mysqli_connect_error());
}

if(isset($_POST["submit"])){

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE userEmail = '$email'")
     or die('Query failed');

    if(mysqli_num_rows($select_users) > 0){

        $row = mysqli_fetch_assoc($select_users);

        // Decrypt password
        if(password_verify($password, $row['userPassword'])) {

            if($row['userType'] == 'admin'){

                $_SESSION['admin_name'] = $row['userName'];
                $_SESSION['admin_email'] = $row['userEmail'];
                header('location: Admin/admin.php'); 

            } elseif($row['userType'] == 'staff'){

                $_SESSION['staff_name'] = $row['userName'];
                $_SESSION['staff_email'] = $row['userEmail'];
                header('location: staff/staffHome.php'); 

            } else{

                $_SESSION['user_name'] = $row['userName'];
                $_SESSION['user_email'] = $row['userEmail'];
                header('location: User/home.php'); 

            }

        } else {
            $message[] = 'Incorrect Email Or Password';
            $_SESSION['message'] = $message; 
            header('location: login.php'); 
        }

    } else {
        $message[] = 'Incorrect Email Or Password';
        $_SESSION['message'] = $message; 
        header('location: login.php'); 
    }
}
?>
