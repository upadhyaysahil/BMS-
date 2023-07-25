<?php

session_start();
if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'])) {
    header("location: login");
}
require '../app/Hidden/functions/user.php';
require '../app/Hidden/functions/authenticate.php';

$uname = $_SESSION['username'];
$isUser = $authenticate->verifyUsername($uname);
if (!$isUser['status']) {
	$showAlert =
	'<div class="notification alert">
		<i class="fa-solid fa-triangle-exclamation"></i>
		User not Found
	</div>';	
}
	$user_id=$isUser['user_id'];
	$result=$user->getUser($user_id);


	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_EMAIL);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $updated=  $user->updateUser($username, $firstname, $lastname, $email, $number, $user_id);
if($updated){
  echo '<div class="notification success">
  <i class="fa-solid fa-triangle-exclamation"></i>
  Message: User Updated Successfully!
</div>';
}


}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="app\Hidden\images\logo.jpeg" type="image/x-icon" />
    <link rel="stylesheet" href="app\Hidden\css\base.css" />
    <link rel="stylesheet" href="app\Hidden\css\nav.css" />
    <link rel="stylesheet" href='app/Hidden/css/login-register.css' />
  </head>

  <body>
    <?php include 'Hidden/Navbar/nav.php'; ?>
    <main>
      <div class="container">
      <?php
                global $showAlert;
                echo  $showAlert;
                ?>
        <section class="title">
          <h3>Profile</h3>
        </section>
        <div class="login-signup-form">
                    <form  method="post" >
                        <div class="form-control">
                            <label for="username">Username</label><br><br>
                            <input type="text" maxlength="14" name="username" id="username" value="<?php echo $result['username']; ?>"placeholder="Enter your Username" required>
                        </div>
                        <div class="form-control">
                            <label for="firstname">First Name</label><br><br>
                            <input type="text" maxlength="14" name="firstname" id="firstname" value="<?php echo $result['firstname']; ?>"placeholder="Enter your firstname" required>
                        </div>
                        <div class="form-control">
                            <label for="lastname">Last Name</label><br><br>
                            <input type="text" maxlength="14" name="lastname" id="lastname" value="<?php echo $result['lastname']; ?>"placeholder="Enter your lastname" required>
                        </div>
                        <div class="form-control">
                            <label for="email">Email</label><br><br>
                            <input type="email" maxlength="35" name="email" id="email" value="<?php echo $result['email']; ?>" placeholder="Enter your Email" required>
                        </div>
                        <div class="form-control">
                            <label for="number">Phone Number</label><br><br>
                            <input type="number" maxlength="35" name="number" id="number" value="<?php echo $result['number']; ?>" placeholder="Enter your Phone Number" required>
                        </div>
              
                        <br>
                        <br>
                        <div class="form-control">
                            <button class="button" type="submit" value="submit">Update</button>
                        </div>
                    </form>
                </div>
      </div>
    </main>
  </body>
</html>
