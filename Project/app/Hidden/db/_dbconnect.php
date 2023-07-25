<?php
$hostName = "localhost";
$userName = "root";
$dbPassWord = "";
$dbName = "bms";
$conn = mysqli_connect($hostName, $userName, $dbPassWord, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
