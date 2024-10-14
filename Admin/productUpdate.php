<?php 
session_start();
include 'dbh.php';
$message = []; 

if(isset($_POST['submit'])){
    
    $itemid = $_POST['id']; 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['categori']; 
    $image = $_FILES['image']['name'];
    $imageTempName = $_FILES['image']['tmp_name'];
    $imageFolder = 'UploadedImages/'.$image;

    
    $select_item = mysqli_query($conn, "SELECT * FROM products WHERE id = $itemid") or die('Query failed');
    if(mysqli_num_rows($select_item) == 0){
        $message[] = 'Item ID does not exist';
    } else {
        
        $update_query = "UPDATE products SET name = '$name', price = '$price', categori = '$category', image = '$image' WHERE id = $itemid";
        $result = mysqli_query($conn, $update_query) or die('Update query failed');

        if($result){
            
            move_uploaded_file($imageTempName, $imageFolder);
            $message[] = 'Product updated successfully!';
            header('locatiion:addProducts.php');
        } else {
            $message[] = 'Product update failed';
        }
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
    <title>Update Product Details</title>
</head>
<body>

<?php include 'adminHeader.php';?>
<section class="addproducts">

<h1 class="title">Update Items</h1>

<form action="" method="post" enctype="multipart/form-data">

    <label for="id">
        Item ID:
    </label>
    <input type="number" id="id" name="id" placeholder="Enter Item ID" required>

    <label for="name">
        Item Name:
    </label>
    <input type="text" id="name" name="name" placeholder="Enter Item Name" required>

    <label for="price">
        Item Price:
    </label>
    <input type="number" id="price" name="price" placeholder="Enter Item Price" required>

    <label for="categori">
        Item Category: 
    </label>
    <input type="text" id="categori" name="categori" placeholder="Enter Item Category">

    <label for="image">
        Item Image:
    </label>
    <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png" required>

    <div class="btn">
        <button type="submit" name="submit">Update</button>
    </div>
</form>
</section>
</body>
</html>
