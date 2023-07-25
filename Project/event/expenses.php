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
$result = $event->getExpensesByUser($user_id, $event_id);



if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['form_name']))) {
	$form_name = $_POST['form_name'];
	echo $form_name;
	if ($form_name == 'form1') {
		if (isset($_POST['form_name'])) {
			$rowId = $_POST['hidden_rowId'];
			$result = $event->deleteExpense($rowId);
			$result = $event->getExpensesByUser($user_id, $event_id);
		}
	} else if ($form_name == 'form2') {

		$expense_name = filter_var($_POST['expense_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$money_spent = filter_var($_POST['money_spent'], FILTER_SANITIZE_EMAIL);
		$bill_date = filter_var($_POST['bill_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$is_received = filter_var($_POST['is_received'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$event->addExpenses($user_id, $expense_name, $money_spent, $bill_date, $is_received, $event_id);
	}
}



?>



<!DOCTYPE html>
<html>

<head>
	<title>Expense Tracker</title>
	<link rel="stylesheet" type="text/css" href="../app/Hidden/css/expenses.css">
	<link rel="stylesheet" href='../app/Hidden/css/nav.css' />
</head>

<body>
	<?php include '../app/Hidden/Navbar/nav.php'; ?>
	<h1>Expense Tracker</h1>

	<div class="container">
		<?php
		global $showAlert;
		echo  $showAlert;
		?>
		<form method="post" name="form2">
			<div class="card">
				<div class="card__content">
					<label for="expense-name">Expense Name:</label>
					<input type="text" id="expense_name" name="expense_name" placeholder="Enter Expense Name"><br>


					<label for="money-spent">Money Spent:</label><br>
					<input type="number" id="money_spent" name="money_spent" min="0" required>

					<label for="is_received">Receipt Received?:</label><br>
					<select name="is_received">
						<option value="no">No</option>
						<option value="yes">Yes</option>
					</select>

					<label for="bill-date">Bill Date:</label><br>
					<input type="date" id="bill_date" name="bill_date" required>
					<input type="hidden" name="form_name" value="form2">

					<br><br><button type="submit" value="submit">Add Expense</button>
				</div>
			</div>
		</form>

		<div class="table">
			<table id="expense-table">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>Receipt</th>
						<th>Expense Name</th>
						<th>Money Spent</th>
						<th>Bill Date</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($result) {
						$index = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>
						<td>" . $index . "</td>
						<td>" . $row["is_received"] . "</td>
						<td>" . $row["expense_name"] . "</td>
						<td>" . $row["money_spent"] . "</td>
						<td>" . $row["bill_date"] . "</td>
						<td><button onclick='deleteRow(" . $row["id"] . ")'>Delete</button></td>
						</tr>";
							$index++;
						}
					} else {
						echo "<tr><td colspan='6'>No events found</td></tr>";
					}
					?>
				</tbody>
			</table>



		</div>
	</div>




	</div>

</body>
<script>
	function deleteRow(rowId) {

		// confirm("are you sure you wish to delete?");
		// Create a form to submit the row ID to the PHP script
		var form = document.createElement('form');
		form.method = 'POST';
		form.name = 'form1';

		// Create a hidden input field to store the row ID
		var input1 = document.createElement('input');
		input1.type = 'hidden';
		input1.name = 'form_name';
		input1.value = "form1";
		form.appendChild(input1);
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'hidden_rowId';
		input.value = rowId;
		form.appendChild(input);

		// Submit the form
		document.body.appendChild(form);
		form.submit();
		var myValue = document.getElementById('input').value;
		document.getElementById('input').value = '';
	}
</script>

</html>