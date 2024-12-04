<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body>
    
    <div class="container">

    <?php 
    include ("php/config.php");
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        //verifying the unique email

        $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

        if(mysqli_num_rows($verify_query) !=0) {
            echo "<div class='message'>
                        <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        } else {
            mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("error Occured");
            echo "<div class='message'>
                        <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
        }

    } else {
    ?>
        <header>Sign Up</header>
       <form method="post" action="">
        <small>To get started, sign up to your account.</small>
       
        <div class="break">
            <div class="empty1"></div>
            <p>Or sign in with</p>
            <div class="empty2"></div>
        </div>

            <div class="field input">
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Username">
            </div>

            <div class="field input">
                <input type="email" name="email" id="email" autocomplete="off" placeholder="Email">
            </div>

            <div class="field input">
                <input type="number" name="age" id="age" autocomplete="off" placeholder="Age">
            </div>

            <div class="field input">
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Password">
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Register" class="btn" required>
            </div>

            <div class="links">
                Already a member? <a href="index.php">Sign In</a>
            </div>
            
       </form>
       <?php } ?>
    </div>

</body>
</html>