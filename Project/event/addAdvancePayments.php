<?php
session_start();
if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'])) {
	header("location: login");
}

require '../app/Hidden/db/_dbconnect.php';
require '../app/Hidden/functions/event.php';
require '../app/Hidden/functions/authenticate.php';

if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
	header("location: ../dashboard");
	exit();
}
$username = $_SESSION['username'];
$isUser = $authenticate->verifyUsername($username);
if (!$isUser['status']) {
	$showAlert =
		'<div class="notification alert">
		<i class="fa-solid fa-triangle-exclamation"></i>
		User not Found
	</div>';
}
$user_id = $isUser['user_id'];
$event_id = $_GET['event_id'];
$result = $event->getPaymentsByUser($user_id, $event_id);



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$cheque_no = filter_var($_POST['cheque_no'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$amount = filter_var($_POST['amount'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$created_at = filter_var($_POST['created_at'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$event->addPayments($user_id, $cheque_no, $amount, $created_at, $event_id);
}
?>



<!DOCTYPE html>
<html>

<head>
	<title>Expense Tracker</title>
	<link rel="stylesheet" type="text/css" href="../app/Hidden/css/addAdvancePayments.css">
	<link rel="stylesheet" href='../app/Hidden/css/nav.css' />
</head>

<body>
	<?php include '../app/Hidden/Navbar/nav.php'; ?>

	<h1>Advance Payment Details</h1>

	<div class="container">
		<div class="card">
			<div class="card__content">

				<form method="post">
					<div>
						<label for="cheque_no">Cheque No:</label>
						<input type="text" id="cheque_no" name="cheque_no" required>
					</div>
					<div>
						<label for="money-spent">Amount:</label>
						<input type="number" id="amount" name="amount" min="1" required>
					</div>
					<div>
						<label for="bill-date">Bill Date:</label>
						<input type="date" id="created_at" name="created_at" required>
					</div>
					<button type="submit" value="submit">Add Advance </button>
				</form>
			</div>
		</div>
		<table id="expense-table">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>cheque no</th>
					<th>Amount</th>
					<th>Advance Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// $sql = "SELECT * FROM payments";
				// $result = mysqli_query($conn, $sql);
				if ($result) {
					$index = 1;
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
						<td>" . $index . "</td>
						<td>" . $row["cheque_no"] . "</td>
						<td>" . $row["amount"] . "</td>
						<td>" . $row["created_at"] . "</td>
						</tr>";
						$index++;

						// usort($created_at, function($a, $b) {
						// 	return strtotime($b['date']) - strtotime($a['date']);
						//   });
					}
				} else {
					echo "<tr><td colspan='4'>No events found</td></tr>";
				}

				?>
			</tbody>
		</table>



	</div>


</body>

</html>