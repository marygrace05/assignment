<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, age = ? WHERE id = ?");
    $stmt->bind_param("ssii", $fullname, $email, $age, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<form method="post">
    <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    <input type="number" name="age" value="<?php echo $user['age']; ?>" required>
    <button type="submit" name="update">Update</button>
</form>
