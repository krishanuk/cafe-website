<?php session_start();?>

<header class="header">
    <div class="nav" > 
        <a href="admin.php" class="logo">The Gallery Cafe</a>
        <nav class="navbar">
            <a href="admin.php">Home</a>
            <a href="addProducts.php">Items</a>
            <a href="messages.php">Messages</a>
            <a href="addusers.php">Users</a>
            <a href="viewOrders.php">Orders</a>
            <a href="viewReservation.php">Reservation</a>
        </nav>
        <div class="icon">
        <i class="fa fa-user-circle-o" style="font-size:36px"></i>
        </div>

        <div class="account">
            <p>UsserName : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="../login.php"><i class="fa fa-sign-out"></i></a>
        </div>
    </div>
   
</header>

