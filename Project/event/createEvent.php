<?php
require '../app/Hidden/functions/event.php';
require '../app/Hidden/functions/authenticate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_name = filter_input(INPUT_POST, 'event_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $event_date = filter_input(INPUT_POST, 'event_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	session_start();
	$username = $_SESSION['username'];
	$isUser = $authenticate->verifyUsername($username);
	if ($isUser['status']) {
		$event->createEvent( $isUser['user_id'], $event_name, $description, $location, $event_date);
	}else{
		echo "user does not exist!";
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>New Event Information Form</title>
	<link rel="stylesheet" type="text/css" href="app\Hidden\css\createEvent.css">
	<link rel="stylesheet" href='app\Hidden\css\base.css' />
    <link rel="stylesheet" href='app\Hidden\css\nav.css' />
</head>

<body>

<?php include '../app/Hidden/Navbar/nav.php'; ?>

	<div class="container">
		<h1>Event Information Form</h1>
		<form class="form" action="createEvent" method="post">
			
		<div class="form-control">
			<label for="event_name">Event Name:</label>
			<input type="text" id="event_name" name="event_name"  placeholder="Enter New Event Name" required>
		</div><br>

		<div class="form-control">
			<label for="description">Event Description:</label>
			<input type="text" id="description" name="description"  placeholder="Enter Event Description" required>
		</div><br>


		<div class="form-control">
			<label for="location">Event location:</label>
			<input type="text" id="location" name="location"  placeholder="Enter Event location" required>
		</div><br>

		<div class="form-control">
			<label for="event_date">Event Date:</label><br>
			<input type="date" id="event_date" name="event_date"   placeholder="Enter Event date" required>
		</div><br><br>

			<div class="form-control">
                            <button class="button" name="Submit">Submit</button>
            </div>
		</form>
	</div>

</body>

</html>