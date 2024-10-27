<?php
$server_name = "localhost";
$username = "root";
$password = ""; 
$db_name = "user_management_db";

$conn = new mysqli($server_name, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
