<?php
        require 'Hidden/db/_dbconnect.php';
        require 'Hidden/functions/event.php';

session_start();
if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'])) {
    header("location: login");
}else{
  $previousCount=$event->getPreviousEventsCount();
  $upcomingCount=$event->getUpcomingEventsCount();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="app\Hidden\images\logo.jpeg" type="image/x-icon" />
    <link rel="stylesheet" href="app\Hidden\css\base.css" />
    <link rel="stylesheet" href="app\Hidden\css\nav.css" />
    <link rel="stylesheet" href="app\Hidden\css\dash.css" />
  </head>

  <body>
    <?php include 'Hidden/Navbar/nav.php'; ?>
    <main>
      <div class="container">
        <section class="title">
          <h3>Dashboard</h3>
        </section>
        <section class="template-container">
          <div class="card"  onclick="document.location='previousEvents'">
            <div class="card-details">
              <p class="text-title">Previous Events</p>
              <p class="text-body"><?php echo $previousCount; ?></p>
              </div>
          </div>
          <div class="card" onclick="document.location='upcomingEvents'">
          <div class="card-details">
              <p class="text-title">Upcoming Events</p>
              <p class="text-body"> <?php echo $upcomingCount; ?></p>
              </div>
        </section>
      </div>
    </main>

    <footer>
  <div class="container">
    <p>&copy; By SAHIL UPADHYAY</p>
  </div>
</footer>

  </body>
</html>
