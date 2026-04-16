<?php
session_start();

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
    header("Location: Login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Protected Page</title>
</head>
<body>
    <h2>Welcome to the protected page!</h2>
    <p>You are successfully logged in.</p>
    
    <p><a href="logout.php">Logout</a></p>
</body>
</html>