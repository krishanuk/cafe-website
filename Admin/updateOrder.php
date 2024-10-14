<?php
include '../dbh.php';


if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $select_order = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id'") or die('query failed');

    if (mysqli_num_rows($select_order) > 0) {
        $fetch_order = mysqli_fetch_assoc($select_order);
    } else {
        echo '<p class="listEmpty">Order not found</p>';
    }
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $userName = $_POST['userName'];
    $userphoneNumber = $_POST['userphoneNumber'];
    $userEmail = $_POST['userEmail'];
    $ordertime = $_POST['ordertime'];
    $orderdate = $_POST['orderdate'];
    $totalProducts = $_POST['totalProducts'];
    $totalPrice = $_POST['totalPrice'];
    $status = $_POST['status'];

    $update_query = mysqli_query($conn, "UPDATE orders SET 
        userName='$userName',
        userphoneNumber='$userphoneNumber',
        userEmail='$userEmail',
        ordertime='$ordertime',
        orderdate='$orderdate',
        totalPrice='$totalPrice',
        status='$status' 
        WHERE id='$order_id'") or die('query failed');

    if ($update_query) {
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
    <title>Update Order</title>
</head>
<body>
<?php include 'adminHeader.php';?>

<section class="update-order">
    <h1 class="title">Update Order</h1>
    <form action="" method="post">
        <input type="hidden" name="order_id" value="<?php echo $fetch_order['id']; ?>">
        <label for="userName">Name:</label>
        <input type="text" name="userName" value="<?php echo $fetch_order['userName']; ?>" required>
        <label for="userphoneNumber">Phone:</label>
        <input type="text" name="userphoneNumber" value="<?php echo $fetch_order['userphoneNumber']; ?>" required>
        <label for="userEmail">Email:</label>
        <input type="email" name="userEmail" value="<?php echo $fetch_order['userEmail']; ?>" required>
        <label for="ordertime">Time:</label>
        <input type="time" name="ordertime" value="<?php echo $fetch_order['ordertime']; ?>" required>
        <label for="orderdate">Order Date:</label>
        <input type="date" name="orderdate" value="<?php echo $fetch_order['orderdate']; ?>" required>
        <label for="status">Order Status:</label>
        <select name="status" required>
            <option value="Pending" <?php if ($fetch_order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="confirmed" <?php if ($fetch_order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="Cancelled" <?php if ($fetch_order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
            <option value="Completed" <?php if ($fetch_order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <input type="submit" name="update_order" value="Update Order" class="order-btn">
    </form>
</section>

</body>
</html>
