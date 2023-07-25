<?php
require 'Hidden/functions/authenticate.php';
require 'Hidden/db/_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Login'])) {
    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($authenticate->verifyUsername($username)) {
        if ($authenticate->confirmPassword($username, $password)) {
            $secure = true;
            $httponly = true;
            session_set_cookie_params(0, '/', '', $secure, $httponly);
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            session_regenerate_id(true);
            $authenticate->loginUser($username);
        } else {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Invalid Password
                </div>';
        }
    } else {
        $showAlert =
            '<div class="notification alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                User does not exist
            </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4c32374ddc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href='app\Hidden\css\base.css' />
    <link rel="stylesheet" href='app\Hidden\css\nav.css' />
    <link rel="stylesheet" href='app\Hidden\css\login-register.css' />
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
                    <h1>SIGN IN</h1>
                </div>
                <div class="login-signup-form">
                    <form action="login" method="GET" name="login-signup" autocomplete="on">
                        <div class="form-control">
                             <i class="fa-solid fa-user"></i>
                            <label for="username">Username</label><br><br>
                            <input type="text" name="username" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="form-control">
                        <i class="fa-solid fa-key"></i>
                            <label for="password">Password</label><br><br>
                            <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <br>
                        <br>
                        <div class="form-control">
                            <button  name="Login">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="account-status">
            <div class="container">
                <p>Don't Have an Account? <a href="signup">&nbsp; <u>Sign Up</u></a></p>
            </div>
        </section>
    </main>
</body>

</html>