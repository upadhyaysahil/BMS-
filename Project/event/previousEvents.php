<?php
require '../app/Hidden/functions/event.php';

if (isset($_POST['hidden_rowId'])) {
    $rowId = $_POST['hidden_rowId'];
    $result = $event->deleteEvent($rowId);
}
session_start();
if (!isset($_SESSION['loggedin']) || !($_SESSION['loggedin'])) {
    header("location: login");
}
$result = $event->getPreviousEvents();


?>

<!DOCTYPE html>
<html>

<head>
    <title>Previous Events</title>
    <link rel="stylesheet" href="app/Hidden/css/previousEvents.css">
    <link rel="icon" href="app\Hidden\images\logo.jpeg" type="image/x-icon" />
    <link rel="stylesheet" href="app\Hidden\css\base.css" />
    <link rel="stylesheet" href="app\Hidden\css\nav.css" />
    <link rel="stylesheet" href="app\Hidden\css\dash.css" />

</head>

<body>
    <?php include '../app/Hidden/Navbar/nav.php'; ?>
    <main>
        <div class="container">
            <section class="title">
                <h3>Previous Events</h3>
            </section>
            <section class="template-container">
                <table>
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // loop through all events and display them in a table row
                        if ($result) {
                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $index. "</td>";
                                echo "<td> <a href='event?id=" . $row["id"] . "'>"  . $row["event_name"] . "</td>";
                                echo "<td>" . $row["location"] . "</td>";
                                echo "<td>" . $row["event_date"] . "</td>";
                                echo "<td><button onclick='deleteRow(" . $row["id"] . ")'>Delete</button></td>";
                                echo "</tr>";
                                $index++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No events found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </section>

        </div>
    </main>
</body>

<script>
    function deleteRow(rowId) {

        // confirm("are you sure you wish to delete?");
        // Create a form to submit the row ID to the PHP script
        var form = document.createElement('form');
        form.action = 'previousEvents';
        form.method = 'POST';

        // Create a hidden input field to store the row ID
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