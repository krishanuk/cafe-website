
<?php 

include 'dbh.php';
$message = []; 


if(isset($_GET['delete'])){
    $delete_message_id = $_GET['delete'];
    
  
    $delete_query = mysqli_query($conn, "DELETE FROM contact WHERE id = '$delete_message_id'");

    if($delete_query){
        header('Location: messages.php'); 
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
    <title>User Messages</title>
</head>
<body>

<?php include 'adminHeader.php';?>
    <section class="messages">
        <h1 class="title">Messages</h1>

        <div class="message-container">
            <?php 
            
            $select_message = mysqli_query($conn, "SELECT * FROM contact") or die('queary failed');

            if(mysqli_num_rows($select_message) > 0){ 
                while($fetch_message = mysqli_fetch_assoc($select_message)){ 
            
            ?>
            <div class="box">
                <p>Name : <span><?php echo $fetch_message['userEmail']; ?></span></p>
                <p>Email : <span><?php echo $fetch_message['userName']; ?></span></p>
                <p>Message : <span><?php echo $fetch_message['userMessage']; ?></span></p>
                <a href="messages.php?delete=<?php echo $fetch_message['id']?>" class="delete-btn">Delete</a>
            </div>
            <?php
                };

            }
            else{
                echo '<p class="listEmpty">No Message To Display</p>';
            }
            ?>
        </div>
    </section>
    
</body>
</html>