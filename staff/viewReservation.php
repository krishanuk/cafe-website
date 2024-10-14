<?php 
include '../dbh.php';
session_start();
$message = []; 

if(isset($_GET['delete'])){
    $delete_res_id = $_GET['delete'];
    
    $delete_query = mysqli_query($conn, "DELETE FROM reservation WHERE id = '$delete_res_id'");

    if($delete_query){
        header('Location: viewReservation.php'); 
        exit;
    } else {
        die('Query failed: ' . mysqli_error($conn));
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
    <link rel="stylesheet" href="../Style/staffStyle.css"> 
    <title>View Reservation</title>
</head>
<body>

<?php include 'staffHeader.php';?>
<div>
<section class="views-reservation">
        <h1 class="title">Reservation Details</h1>

        <div class="res-container">
            <?php 
            
            $select_res = mysqli_query($conn, "SELECT * FROM reservation") or die('query failed');

            if(mysqli_num_rows($select_res) > 0){ 
                while($fetch_res = mysqli_fetch_assoc($select_res)){ 
            
            ?>
            <div class="res-box">
                <p>ID : <span><?php echo $fetch_res['id']; ?></span></p>
                <p>Name : <span><?php echo $fetch_res['userName']; ?></span></p>
                <p>Phone : <span><?php echo $fetch_res['userphoneNumber']; ?></span></p>
                <p>Email : <span><?php echo $fetch_res['userEmail']; ?></span></p>
                <p>Table : <span><?php echo $fetch_res['tableNumber']; ?></span></p>
                <p>Reserved Time : <span><?php echo $fetch_res['restime']; ?></span></p>
                <p>Reserved Date : <span><?php echo $fetch_res['resdate']; ?></span></p>
                <p>Reservation Status : <span><?php echo $fetch_res['status']; ?></span></p>
                <a href="viewReservation.php?delete=<?php echo $fetch_res['id']?>" class="delete-btn">Delete</a>
                <a href="updateReservation.php?id=<?php echo $fetch_res['id']; ?>" class="order-btn">Update</a>
                
            </div>
            <?php
                };

            }
            else{
                echo '<p class="listEmpty">No Reservation To Display</p>';
            }
            ?>
        </div>
    </section>
    </div>
</body>
</html>
