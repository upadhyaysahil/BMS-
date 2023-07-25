<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../app/Hidden/css/event.css">

</head>
<body>
<div>
<a href="../advancePayments/addAdvancePayments.php?event_id=<?php echo $_GET['id'] ?>"> Add advance payment</a> <br>

		<a href="../expenses/expenses.php?event_id=<?php echo $_GET['id'] ?>"> Add expenses</a>
	</div>

    <div class="card">
    <h2>Payment Details</h2>
    <p><strong>Advance:</strong> $200</p>
    <p><strong>Cheque Details:</strong> ABC Bank, Check #12345</p>
    <p><strong>Balance:</strong> $300</p>
  </div>
</body>
</html>