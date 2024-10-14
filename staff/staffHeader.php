

<header class="header">
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
    <div class="nav" > 
        <a href="admin.php" class="logo">The Gallery Cafe</a>
        <nav class="navbar">
            <a href="staffHome.php">Home</a>
            <a href="viewOrders.php">Orders</a>
            <a href="viewReservation.php">Reservation</a>

        </nav>
        <div class="icon">
        <i class="fa fa-user-circle-o" style="font-size:36px"></i>
        </div>

        <div class="account">
            <p>UsserName : <span><?php echo $_SESSION['staff_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['staff_email']; ?></span></p>
            <a href="../login.php"><i class="fa fa-sign-out"></i></a>
        </div>
    </div>
</header>

