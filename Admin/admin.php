<?php 
include 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style>

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/adminStyle.css">
    <title>Admin Panel</title>
</head>
<body>
<?php include 'adminHeader.php';?>

    <!-- Admin dashbord Start -->

    <section class="dashboard">
        <h1 class="heading">Welcome Admin:<span><?php echo $_SESSION['admin_name']; ?></span></h1>
        <div class="box-container">

       <div class="box">
        <?php 
            
            $selectUsers = mysqli_query($conn, "SELECT * FROM users;") or die('query faild');
            $numberOfOUsers = mysqli_num_rows($selectUsers);
        ?>

        <h3><?php echo $numberOfOUsers; ?></h3>
        <p>Users Count</p>
       </div>

       <div class="box">
        <?php 
            
            $selectReservation = mysqli_query($conn, "SELECT * FROM reservation;") or die('query faild');
            $numberOfReservation = mysqli_num_rows($selectReservation);
        ?>

        <h3><?php echo $numberOfReservation; ?></h3>
        <p>Reservation Count</p>
       </div>

       <div class="box">
        <?php 
            
            $selectProducts = mysqli_query($conn, "SELECT * FROM products;") or die('query faild');
            $numberOfProducts = mysqli_num_rows($selectProducts );
        ?>

        <h3><?php echo $numberOfProducts; ?></h3>
        <p>Item Count</p>
       </div>

       

        </div>
    </section>

    <!-- Admin dashbord End -->

</body>
</html>