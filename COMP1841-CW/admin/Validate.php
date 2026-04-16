<?php
session_start();
include '../includes/DatabaseConnection.php';

$input    = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Admin cứng
if ($input === 'admin' && $password === '123') {
    $_SESSION['authorized'] = true;
    $_SESSION['role'] = 'admin';
    $_SESSION['user_id'] = 0;
    header("Location: ../index.php");
    exit;
}

// User đã register (bảng users)
$stmt = $pdo->prepare('SELECT id, name, email, password FROM users 
                       WHERE name = ? OR email = ?');
$stmt->execute([$input, $input]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['authorized'] = true;
    $_SESSION['role'] = 'user';
    $_SESSION['user_id'] = $user['id'];
    header("Location: ../index.php");
    exit;
}

// User demo
elseif ($input === 'user' && $password === '123') {
    $_SESSION['authorized'] = true;
    $_SESSION['role'] = 'user';
    $_SESSION['user_id'] = 1;
    header("Location: ../index.php");
    exit;
} 

// Sai
else {
    header("Location: Wrongpassword.php");
    exit;
}
?>