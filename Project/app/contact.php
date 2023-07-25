<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BMS | Templates</title>
    <meta charset="utf-8" />
    <meta name="author" content="Sahil Upadhyay" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="app\Hidden\css\base.css" />
    <link rel="stylesheet" href="app\Hidden\css\nav.css" />
    <link rel="stylesheet" href="app\Hidden\css\login-register.css" />
  </head>

  <body>
    <?php include 'Hidden/Navbar/nav.php'; ?>
    <main>
      <div class="container">
        <section class="title">
          <h3>Contact Admin</h3>
          <div class="login-signup-form">
                    <form action="contact" method="post" name="contactAdmin" autocomplete="on">
                        <div class="form-control">
                            <label for="username">Name</label><br><br>
                            <input type="text" maxlength="14" name="username" id="username" placeholder="Enter your Name" required>
                        </div>
                        <div class="form-control">
                            <label for="email">Email</label><br><br>
                            <input type="email" maxlength="35" name="email" id="email" placeholder="Enter your Email" required>
                        </div>
                        <div class="form-control">
                            <label for="number">Phone Number</label><br><br>
                            <input type="number" maxlength="10" name="number" id="number" placeholder="Enter your Phone Number" required>
                        </div>
                        <div class="form-control">
                            <label for="text">Text </label><br><br>
                            <input type="text" maxlength="500" name="text1" id="text" placeholder="Enter your Message" required>
                        </div>
                        <br>
                        <br>
                        <div class="form-control">
                            <button class="button" name="Signup">Submit</button>
                        </div>
                    </form>
                </div>
        </section>
 
      </div>
    </main>
  </body>
</html>
