<?php
session_start();
include 'dbh.php';

$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
$message = []; 

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_email'])) {
        header('location: ../login.php');
        exit();
    }

    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE Names='$product_name' AND userEmail='$user_email'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already added to cart';
    } else {
        mysqli_query($conn, "INSERT INTO cart (Names, userEmail, price, quantity, images) VALUES ('$product_name', '$user_email', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Added to cart';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/homeStyle.css">
    <title>Home</title>
</head>
<body>
    <?php include 'mainHeader.php' ?>

    <section class="products">
        <div class="box-container">
            <?php 
                $select_products = mysqli_query($conn, "SELECT * FROM products") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                        <form action="" method="post">
                            <img src="../Admin/UploadedImages/<?php echo $fetch_products['image']; ?>" alt="" class="product-image">
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
                            <input type="number" min="1" name="product_quantity" value="1" class="qty" <?php echo !$user_email ? 'disabled' : ''; ?>>

                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                            <input type="submit" value="Add to cart" name="add_to_cart" class="btn" <?php echo !$user_email ? 'disabled title="Please login to add to cart"' : ''; ?>>
                        </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">No Products Added Yet!</p>';
                }
            ?>
        </div>
    </section>

    <?php include 'footer.php' ?>
</body>
</html>
