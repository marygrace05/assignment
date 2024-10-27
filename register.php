<?php
session_start();
require 'db.php'; // Include database connection

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, age) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $fullname, $email, $password, $age);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error registering user.";
    }
}
?>

<form method="post">
    <input type="text" name="fullname" required placeholder="Full Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <input type="number" name="age" required placeholder="Age">
    <button type="submit" name="register">Register</button>
</form>
<?php if (isset($error)) echo $error; ?>
