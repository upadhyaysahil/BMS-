<?php
require '../app/Hidden/functions/event.php';
session_start();

if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'])) {
  header("location: login");
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("location: ../dashboard");
  exit();
}
$event_id = $_GET['id'];
$paymentInfo = $event->getEventPaymentInfo($event_id);
$event = $event->getEvent($event_id);

?>

<html>

<head>
  <title>Event</title>
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href='../app/Hidden/css/base.css' />
  <link rel="stylesheet" type="text/css" href='../app/Hidden/css/nav.css' />
</head>

<body>
  <?php include '../app/Hidden/Navbar/nav.php'; ?>
  <main>

    <div class="container">
      <div class="Pcard">
          <div class="Pcard__content">
            <h1>Event name </h1>
            <p><?php echo $event['event_name']; ?></p>
            <h1>Event location </h1>
            <p><?php echo $event['location']; ?></p>
            <h1>Event date </h1>
            <p><?php echo $event['event_date']; ?></p>
          </div>
      </div>
      <div class="card">
          <div class="card__content">
            <h2>Payment Details</h2>
            <p><strong>Total Advance:</strong> <?php echo $paymentInfo['total_payments']; ?> </p>
            <p><strong>Total spents:</strong> <?php echo $paymentInfo['total_expenses']; ?></p>
            <p><strong>Balance:</strong> <?php echo $paymentInfo['balance']; ?> </p>
          </div>
        <div>
          <button onclick="document.location='addAdvancePayments.php?event_id=<?php echo $event_id; ?>'"> Add Adavance payment</button>
          <br>
          <br>
          <button onclick="document.location='expenses.php?event_id=<?php echo $event_id; ?>'"> Add expenses</button>

        </div>
      </div>

  </main>
</body>

</html>