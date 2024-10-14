<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="Style/loginStyle.css">
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
            <form action="loginSubmit.php" method="post">
                <label for="email">
                    Email:
                </label>
                <input type="email" id="email" name="email" placeholder="Enter your Email Here" required>

                <label for="password">
                    Password:
                </label>
                <input type="password" id="password" name="password" placeholder="Enter Your Password Here" required>

                <div class="btn">
                    <button type="submit" name="submit">Login</button>
                </div>

            </form>
            <p>Not Registered? <a href="register.php">Create an account</a></p>
        </div>
    </div>
</body>

</html>
