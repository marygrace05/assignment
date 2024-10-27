<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");

echo "<h2>Registered Users</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Actions</th></tr>";

while ($user = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$user['id']}</td>
            <td>{$user['full_name']}</td>
            <td>{$user['email']}</td>
            <td>{$user['age']}</td>
            <td>
                <a href='update.php?id={$user['id']}'>Update</a> | 
                <a href='delete.php?id={$user['id']}'>Delete</a>
            </td>
          </tr>";
}

echo "</table>";
?>
<a href="logout.php">Logout</a>
