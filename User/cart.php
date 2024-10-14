<?php

include 'dbh.php';

session_start();

if(isset($_SESSION['user_email'])){
    $userEmail = $_SESSION['user_email'];
 }else{
    $userEmail = '';
    header('location: ../login.php');
    exit();
 };

 if(isset($_POST['update_cart'])){

    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    mysqli_query($conn, "UPDATE cart SET quantity = '$cart_quantity' WHERE id='$cart_id'") or die('queary failed');
    $message[] = 'Card queantity Updated!';
 }

 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id'") or die('queary failed!');
    header('location: cart.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/homeStyle.css">
    <title>Product Cart</title>
</head>
<body>

<?php include 'mainHeader.php' ?>



<section class="shopping-cart">

    <h1 class="title">Shopping Cart Items</h1>

    <div class="box-container">

    <?php

        $grand_Total = 0;

        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE userEmail = '$userEmail'") or die('queary failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){


        
    
    ?>

        <div class="box">
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fa fa-remove" style="font-size:24px;color:red"></a>
            <img src="../Admin/UploadedImages/<?php echo $fetch_cart['images']; ?>" alt="">
            <div class="name"><?php echo $fetch_cart['Names']; ?></div>
            <div class="price">Rs<?php echo $fetch_cart['price']; ?>/-</div>
            <form action="" method="post">
                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                <input type="number" min ="1" name ="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                <input type="submit" name="update_cart" value="Update" class="option-btn">
            </form>

            <div class="sub-total">
                Sub total : <span> Rs<?php echo $sub_total =($fetch_cart['quantity'] * $fetch_cart['price']); ?> /-</span>
            </div>
        </div>

    <?php

    $grand_Total += $sub_total;
            }
        }else{
        
        echo '<p class="empty-cart">Cart is Empty</p>';
        
        }
    ?>

    </div>

    <div class="cart-total">
        <p>Grand Total : <span>Rs<?php echo $grand_Total ?>/-</span></p>
    </div>
    <div class="flex">
        <a href="confirmeOrder.php" ><button <?php echo ($grand_Total > 1)?'':'disabled' ?>>Proceed to Shopping</button></a>
    </div>

</section>


<?php include 'footer.php' ?>
    
</body>
</html>