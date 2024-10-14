<?php include 'registerSubmit.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/loginStyle.css">
    <title>Registration Form</title>
    <script>
        function validateForm(event) {
            var password = document.getElementById("password").value;
            var repassword = document.getElementById("Repassword").value;

            if (password !== repassword) {
                alert("Passwords do not match.");
                event.preventDefault(); // Prevent form submission
            }
        }
    </script>
</head>
<body>
    <div class="main">
        <div class="container">
            <h2>The Gallery Cafe</h2>

            <?php
            session_start();

            if (isset($_SESSION['message'])) {
                echo '<div class="message-container">';
                echo '<ul>';
                foreach ($_SESSION['message'] as $msg) {
                    echo '<li>' . htmlspecialchars($msg) . '</li>'; 
                }
                echo '</ul>';
                echo '</div>';
                // Clear the message
                unset($_SESSION['message']);
            }
            ?>
            <h4>Register Form</h4>
            <form action="registerSubmit.php" method="post" onsubmit="validateForm(event)">
                <label for="name">
                    Username:
                </label>
                <input type="text" id="name" name="name" placeholder="Enter your Name Here" required>

                <label for="email">
                    Email:
                </label>
                <input type="email" id="email" name="email" placeholder="Enter your Email Here" required>

                <label for="phoneNumber">
                    Phone Number:
                </label>
                <input type="phone" id="phone" name="phone" placeholder="Enter your Phone Number Here" required pattern="[0-9]{10}">

                <label for="password">
                    Password:
                </label>
                <input type="password" id="password" name="password" placeholder="Enter your Password " required>

                <label for="Repassword">
                   Repeat Password:
                </label>
                <input type="password" id="Repassword" name="Repassword" placeholder="Confirm your Password " required>

                <div class="btn">
                    <button type="submit" name="submit">Sign Up</button>
                </div>
            </form>
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </div>
    </div>
</body>
</html>
