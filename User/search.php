<?php
session_start();
include 'dbh.php'; 

if (!isset($_SESSION['user_email'])) {
    
    header('location: ../login.php');
    exit();
}

$user_email = $_SESSION['user_email'];
$message = []; 

if(isset($_POST['add_to_cart'])){
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE Names='$product_name' AND userEmail='$user_email'");
    
    if(!$check_cart_numbers) {
        die('Query failed: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Already added to cart';
    } else {
        $insert_query = "INSERT INTO cart (Names, userEmail, price, quantity, images) 
                        VALUES ('$product_name', '$user_email', '$product_price', '$product_quantity', '$product_image')";
        $insert_result = mysqli_query($conn, $insert_query);
        
        if(!$insert_result) {
            die('Insert query failed: ' . mysqli_error($conn));
        }
        
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
    <title>Search Page</title>
</head>
<body>

<?php include 'mainHeader.php' ?>

<section class="search">
    <form action="" method="post">
        <input type="text" name="search" placeholder="Search here.." class="search-input">
        <button type="submit" name="submit">Search</button>
    </form>
</section>

<section class="product" style="padding-top: 0;">
    <div class="box-container">

    <?php 
    if(isset($_POST['submit'])){
        $search_item = mysqli_real_escape_string($conn, $_POST['search']);
        $select_products = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search_item%' OR categori LIKE '%$search_item%' ");

        if(!$select_products) {
            die('Search query failed: ' . mysqli_error($conn));
        }

        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
                <form action="" method="post">
                    <img src="../Admin/UploadedImages/<?php echo $fetch_products['image']; ?>" alt="" class="product-image">
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <input type="submit" value="Add to cart" name="add_to_cart" class="btn">
                </form>
    <?php
            }
        } else {
            echo '<p class="empty">Item not found!</p>';
        }
    } else {
        echo '<p class="empty">Search for an item!</p>';
    }
    ?>

    </div>
</section>

<?php include 'footer.php' ?>

</body>
</html>
