<?php
class Authenticate
{
    public function createAccount($username, $email, $password) //Creates an account
    {
        require 'Hidden/db/_dbconnect.php';
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hash);
            $result = $stmt->execute();
            if ($result) {
                header("location: login");
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

    public function loginUser($username) //Logs in the user and starts the session
    {
        require 'Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM event WHERE event_date < NOW() ORDER BY event_date ASC;";
            $upresult = $conn->query($sql);

            $sql = "SELECT * FROM event WHERE event_date > NOW() ORDER BY event_date ASC;";
            $presult = $conn->query($sql);
            // $count = $presult->num_rows;

            if ($presult->num_rows > 0 || $upresult->num_rows > 0) {
                header("location: dashboard");
            } else {
                header("location: dashboard");
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
    
    public function verifyUsername($validateUsername) //Checks whether the username is available
    {
        require '../app/Hidden/db/_dbconnect.php';
        $sql = "SELECT id, username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $validateUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$result->num_rows > 0) {
            return false;
        } else {
            $response = [
                'status' => true,
                'user_id' => $row['id'],
              ];
            return  $response;
             }
    }

    public function verifyEmail($validateEmail) //Checks whether the email has already been used
    {
        require 'Hidden/db/_dbconnect.php';
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $validateEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function confirmPassword($username, $password) //Checks whether the password is correct
    {
        require 'Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT password FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return password_verify($password, $row['password']);
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
$authenticate = new Authenticate();
