<?php
require 'Hidden/db/_dbconnect.php';
require 'Hidden/functions/authenticate.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Signup'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($password == $cpassword) {
        if (!$authenticate->verifyUsername($username)) {
            if (!$authenticate->verifyEmail($email)) {
                $authenticate->createAccount($username, $email, $password);
            } else {
                $showAlert =
                    '<div class="notification alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Email already exists
                    </div>';
            }
        } else {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Username already exists
                </div>';
        }
    } else {
        $showAlert =
            '<div class="notification alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Passwords do not match
            </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign UP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c32374ddc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href='app/Hidden/css/base.css' />
    <link rel="stylesheet" href='app/Hidden/css/nav.css' />
    <link rel="stylesheet" href='app/Hidden/css/login-register.css' />
</head>

<body>
    <?php include 'Hidden/Navbar/nav.php'; ?>
    <main>
        <section class="login-signup">
            <div class="container">
                <?php
                global $showAlert;
                echo  $showAlert;
                ?>
                <div class="title">
                    <h1>SIGN UP</h1>
                </div>
                <div class="login-signup-form">
                    <form action="signup" method="post" name="login-signup" autocomplete="on">
                        <div class="form-control">
                            <i class="fa-solid fa-user"></i>
                            <label for="username">Username</label><br><br>
                            <input type="text" maxlength="14" name="username" id="username" placeholder="Enter your Username" required>
                        </div>
                        <div class="form-control">
                            <i class="fa-solid fa-envelope"></i>
                            <label for="email">Email</label><br><br>
                            <input type="email" maxlength="35" name="email" id="email" placeholder="Enter your Email" required>
                        </div>
                        <div class="form-control">
                        <i class="fa-solid fa-mobile"></i>
                            <label for="number">Phone Number</label><br><br>
                            <input type="number" maxlength="35" name="number" id="number" placeholder="Enter your Phone Number" required>
                        </div>
                        <div class="form-control">
                        <i class="fa-solid fa-key"></i>
                            <label for="password">Password</label><br><br>
                            <input type="password" maxlength="14" name="password" id="password" placeholder="Enter your Password" required>
                        </div>
                        <div class="form-control">
                        <i class="fa-solid fa-lock"></i>
                            <label for="password">Re-Enter Password</label><br><br>
                            <input type="password" name="cpassword" id="cpassword" placeholder="Enter your Password" required>
                        </div>
                        <br>
                        <br>
                        <div class="form-control">
                            <button class="button" name="Signup">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="account-status">
            <div class="container">
                <p>Already Have an Account? <a href="login">&nbsp; <u>Sign In</u></a> </p>
            </div>
        </section>
    </main>
</body>

</html>