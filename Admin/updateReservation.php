<?php
include '../dbh.php';


if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $select_res = mysqli_query($conn, "SELECT * FROM reservation WHERE id = '$reservation_id'") or die('query failed');

    if (mysqli_num_rows($select_res) > 0) {
        $fetch_res = mysqli_fetch_assoc($select_res);
    } else {
        echo '<p class="listEmpty">Reservation not found</p>';
    }
}

if (isset($_POST['update_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    $userName = $_POST['userName'];
    $userphoneNumber = $_POST['userphoneNumber'];
    $userEmail = $_POST['userEmail'];
    $tableNumber = $_POST['tableNumber'];
    $restime = $_POST['restime'];
    $resdate = $_POST['resdate'];
    $status = $_POST['status'];

    $update_query = mysqli_query($conn, "UPDATE reservation SET 
        userName='$userName',
        userphoneNumber='$userphoneNumber',
        userEmail='$userEmail',
        tableNumber='$tableNumber',
        restime='$restime',
        resdate='$resdate',
        status='$status' 
        WHERE id='$reservation_id'") or die('query failed');

    if ($update_query) {
        header('Location: viewReservation.php');
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
    <title>Update Reservation</title>
</head>
<body>
<?php include 'adminHeader.php';?>

<section class="update-reservation">
    <h1 class="title">Update Reservation</h1>
    <form action="" method="post">
        <input type="hidden" name="reservation_id" value="<?php echo $fetch_res['id']; ?>">
        <label for="userName">Name:</label>
        <input type="text" name="userName" value="<?php echo $fetch_res['userName']; ?>" required>
        <label for="userphoneNumber">Phone:</label>
        <input type="text" name="userphoneNumber" value="<?php echo $fetch_res['userphoneNumber']; ?>" required>
        <label for="userEmail">Email:</label>
        <input type="email" name="userEmail" value="<?php echo $fetch_res['userEmail']; ?>" required>
        <label for="tableNumber">Table:</label>
        <input type="text" name="tableNumber" value="<?php echo $fetch_res['tableNumber']; ?>" required>
        <label for="restime">Reserved Time:</label>
        <input type="time" name="restime" value="<?php echo $fetch_res['restime']; ?>" required>
        <label for="resdate">Reserved Date:</label>
        <input type="date" name="resdate" value="<?php echo $fetch_res['resdate']; ?>" required>
        <label for="status">Reservation Status:</label>
        <select name="status" required>
            <option value="Pending" <?php if ($fetch_res['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Confirmed" <?php if ($fetch_res['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
            <option value="Cancelled" <?php if ($fetch_res['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <input type="submit" name="update_reservation" value="Update Reservation" class="reservation-btn">
    </form>
</section>

</body>
</html>
