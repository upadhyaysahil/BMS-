<?php
class User
{
    public function getUser($user_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_id);
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
    public function updateUser($username, $firstname, $lastname, $email, $number, $user_id) //Creates an account
    {
        require '../app/Hidden/db/_dbconnect.php';
        try {
            $sql = "UPDATE users SET username = ?, firstname = ?, lastname = ?, email = ?, number = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss",$username,$firstname,$lastname,$email,$number, $user_id);
            $result = $stmt->execute();

            if (!$result) {
                return false;
            } else {
                return true;
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
$user = new User();
