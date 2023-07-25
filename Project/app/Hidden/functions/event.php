<?php
class Event
{
    public function createEvent($user_id, $event_name, $description, $location, $event_date) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "INSERT INTO event (user_id, event_name, description, location, event_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $user_id, $event_name, $description, $location, $event_date);
            $result = $stmt->execute();
            
            if ($result) {
                $event_id = mysqli_insert_id($conn);

                header("location: event?id=" . $event_id);

            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function addPayments($user_id, $cheque_no, $amount, $created_at, $event_id) //add expenses
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "INSERT INTO payments (user_id, cheque_no, amount, created_at, event_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $user_id, $cheque_no, $amount, $created_at, $event_id);
            $result = $stmt->execute();
            
            if ($result) {
                header("location: addAdvancePayments.php?event_id=" . $event_id);
                echo  '<div class="notification alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Message: Payments added Successfully!
                    </div>';
            }else{
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function addExpenses($user_id, $expense_name, $money_spent, $bill_date, $is_received, $event_id) //add expenses
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "INSERT INTO expenses (user_id, expense_name, money_spent, bill_date, is_received, event_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $user_id, $expense_name, $money_spent, $bill_date, $is_received, $event_id);
            $result = $stmt->execute();
            
            if ($result) {
                header("location: expenses.php?event_id=" . $event_id);
                echo  '<div class="notification ">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Message: Expense added Successfully!
                    </div>';
            }else{
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getExpensesByUser($user_id, $event_id) //get expenses
    {
        require '../app/Hidden/db/_dbconnect.php';

        try {
            $sql = "SELECT * FROM expenses  WHERE user_id = ? AND event_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$user_id, $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $result;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getPaymentsByUser($user_id, $event_id) //get expenses
    {
        require '../app/Hidden/db/_dbconnect.php';

        try {
            $sql = "SELECT * FROM payments  WHERE user_id = ? AND event_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss",$user_id, $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
         
            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $result;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }
    public function getEvent($event_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $row;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function deleteEvent($event_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "DELETE FROM event WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $event_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }
    public function deleteExpense($expense_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "DELETE FROM expenses WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $expense_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getEventPaymentInfo($event_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT event.id, event.event_name, 
       COALESCE(payments.total_payments, 0) AS total_payments, 
       COALESCE(expenses.total_expenses, 0) AS total_expenses, 
       COALESCE(payments.total_payments, 0) - COALESCE(expenses.total_expenses, 0) AS balance             FROM event
            LEFT JOIN (
            SELECT event_id, SUM(amount) AS total_payments 
            FROM payments 
            GROUP BY event_id
        ) AS payments ON payments.event_id = event.id
        LEFT JOIN (
            SELECT event_id, SUM(money_spent) AS total_expenses 
            FROM expenses 
            GROUP BY event_id
        ) AS expenses ON expenses.event_id = event.id
            where event.id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $event_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $row;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getPreviousEvents() //Creates an account
    {

        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE event_date < NOW() ORDER BY event_date ASC;";
            $previousEvents = $conn->query($sql);


            if (!$previousEvents->num_rows > 0) {
                return false;
            } else {
                return $previousEvents;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getPreviousEventsCount() //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE event_date < NOW() ORDER BY event_date ASC;";
            $result = $conn->query($sql);
            $previousCount = $result->num_rows;


            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $previousCount;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }
    public function getUpcomingEvents() //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE event_date > NOW() ORDER BY event_date ASC;";
            $upcomingEvents = $conn->query($sql);

            if (!$upcomingEvents->num_rows > 0) {
                return false;
            } else {
                return $upcomingEvents;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

    public function getUpcomingEventsCount() //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE event_date > NOW() ORDER BY event_date ASC;";
            $result = $conn->query($sql);
            $upcomingCount = $result->num_rows;

            if (!$result->num_rows > 0) {
                return false;
            } else {
                return $upcomingCount;
            }
        } catch (mysqli_sql_exception $e) {
            $showAlert =
                '<div class="notification alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    MySqlException: ' . $e->getMessage() . '<br />' . $sql . '
                </div>';
            echo $showAlert;
        }
    }

}
$event = new Event();