<?php 
    session_start();
    include("php/config.php");

    if (isset($_POST['submit'])) {
        // Corrected mysqli_real_escape_string typo
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Query the database
        $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Query failed: " . mysqli_error($con));
        $row = mysqli_fetch_assoc($result);

        // Check if the user exists
        if (is_array($row) && !empty($row)) {
            // Set session variables
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['age'] = $row['Age'];
            $_SESSION['id'] = $row['Id'];

            // Redirect to home page
            header("Location: home.php");
            exit(); // Ensure the script stops after redirect
        } else {
            $message = "Wrong Username or Password!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <header>Login</header>
        <form method="post" action="">
            <small>To get started, sign in to your account.</small>

            <div class="field input">
                <input type="text" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="field input">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Login" class="btn">
            </div>

            <div class="links">
                Don't have an account? <a href="register.php">Sign Up Now</a>
            </div>
        </form>

        <?php 
        // Display error message if login fails
        if (!empty($message)) {
            echo "<div class='message'><p>$message</p></div>";
        }
        ?>
    </div>
</body>
</html>
