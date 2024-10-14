<?php 

include 'dbh.php';
$message = []; 

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['categori'];
    $image = $_FILES['image']['name'];
    $imageTempName = $_FILES['image']['tmp_name'];
    $imageFolder = 'UploadedImages/'.$image;

    $select_item_name = mysqli_query($conn, "SELECT name FROM products WHERE name = '$name'") or die('query failed');

    if(mysqli_num_rows($select_item_name) > 0){
        $message[] = 'Item Name Already Added';
    } else {
        $add_item_query = "INSERT INTO products (name, price, categori, image) VALUES ('$name', '$price', '$category', '$image')";
        $result = mysqli_query($conn, $add_item_query) or die('query failed');

        if($result){
            move_uploaded_file($imageTempName, $imageFolder);
            $message[] = 'Product added successfully!';
        } else {
            $message[] = 'Product adding failed';
        }
    }
}

if(isset($_GET['delete'])){
    $delete_product_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_product_id'") or die('query failed');
    header('locatiion:addProducts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Style/adminStyle.css">
    <title>Add Products</title>
</head>
<body>

<?php include 'adminHeader.php';?>

             <!--Add Products Section Start -->

<section class="addproducts">

    <h1 class="title">Manage Items</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">
            Item Name:
        </label>
        <input type="text" id="name" name="name" placeholder="Enter Item Name" required>

        <label for="price">
            Item Price:
        </label>
        <input type="number" id="price" name="price" placeholder="Enter Item Price" required>

        <label for="categori">
            Item Categori:
        </label>
        <input type="text" id="categori" name="categori" placeholder="Enter Item Categori">

        <label for="Image">
            Item Image:
        </label>
        <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png" required>

        <div class="btn">
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</section>

         <!--Add Products Section Ending -->


        <!--    Display Product Section Start -->

    <section class="displayProducts">
    <div class="productContainer">

    <?php
        $select_all_products = mysqli_query($conn, "SELECT * FROM products") or die('Query failed: ' . mysqli_error($conn));

        if(mysqli_num_rows($select_all_products) > 0){
            while($fetch_all_products = mysqli_fetch_assoc($select_all_products)) {
                if ($fetch_all_products !== null) { 
    ?>

        <div class="product">
            <img src="UploadedImages/<?php echo htmlspecialchars($fetch_all_products['image']); ?>" alt="">
            <p class="productname"><?php echo $fetch_all_products['id']?>: <?php echo $fetch_all_products['name']?></p>
            <p class="productname">$<?php echo $fetch_all_products['price']?></p>
            <p class="productname">Category <?php echo $fetch_all_products['categori']?></p>
            <a href="productUpdate.php" class="update-btn">Update</a>
            <a href="addProducts.php?delete=<?php echo $fetch_all_products['id']?>" class="delete-btn">Delete</a>
        </div>

    <?php 
                }
            }  
        } else {
            echo '<p class="listEmpty">Product List Empty</p>';
        }
    ?>

    </div>
</section>

        

</body>
</html>
