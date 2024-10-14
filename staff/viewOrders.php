<?php 
include '../dbh.php';
session_start();
$message = []; 

if(isset($_GET['delete'])){
    $delete_message_id = $_GET['delete'];
    
  
    $delete_query = mysqli_query($conn, "DELETE FROM orders WHERE id = '$delete_message_id'");

    if($delete_query){
        header('Location: viewOrders.php'); 
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
    <title>View Orders</title>
</head>
<body>

<?php include 'staffHeader.php';?>

<section class="view-reservation">
        <h1 class="title">Orders Details</h1>

        <div class="res-container">
            <?php 
            
            $select_order = mysqli_query($conn, "SELECT * FROM orders") or die('queary failed');

            if(mysqli_num_rows($select_order) > 0){ 
                while($fetch_order = mysqli_fetch_assoc($select_order)){ 
            
            ?>
            <div class="box">
                <p>ID : <span><?php echo $fetch_order['id']; ?></span></p>
                <p>Name : <span><?php echo $fetch_order['userName']; ?></span></p>
                <p>Phone : <span><?php echo $fetch_order['userphoneNumber']; ?></span></p>
                <p>Email : <span><?php echo $fetch_order['userEmail']; ?></span></p>
                <p>Time : <span><?php echo $fetch_order['ordertime']; ?></span></p>
                <p>order Date : <span><?php echo $fetch_order['orderdate']; ?></span></p>
                <p>Products : <span><?php echo $fetch_order['totalProducts']; ?></span></p>
                <p>Price : <span><?php echo $fetch_order['totalPrice']; ?></span></p>
                <p>Order Status : <span><?php echo $fetch_order['status']; ?></span></p>
                <a href="viewOrders.php?delete=<?php echo $fetch_order['id']?>" class="order-btn">Delete</a>
                <a href="updateOrder.php?id=<?php echo $fetch_order['id']; ?>" class="order-btn">Update</a>


                
            </div>
            <?php
                };

            }
            else{
                echo '<p class="listEmpty">No Orders To Display</p>';
            }
            ?>
        </div>


        <section></section>
    </section>
</body>
</html>