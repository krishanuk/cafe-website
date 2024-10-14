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
<div class="header-2">
   <div class="flex">

   <div class="navbar">
    <a href="home.php" class="logo">The Gallery Cafe</a>
    <a href="home.php">Home</a>
    <a href="menu.php">Menu</a> 
    <a href="addReservation.php">Reservation</a>
    <a href="order.php">Orders</a>
    <a href="about.php">About</a>
    <a href="contactforum.php">Contact</a>

</div>

    <div class="icons">
        <div class="menu-btn" class="fa fa-bars">
            <a href="search.php" class="fa fa-search"></a>        
            <div class="user-btn" class="fa fa-user-circle"></div>
            <a href="cart.php" ><i class="fa fa-cart-arrow-down"></i></a>
            <a href="../login.php"><i class="fa fa-sign-out"></i></a>
            
        </div> 
    </div>

   </div>
</div>
</header>
