<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

// Only allow logged-in admin to delete contacts
$isAdmin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true && $_SESSION['role'] === 'admin';

if (!$isAdmin) {
    die("ERROR: You must be logged in as Admin to delete contact messages.");
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ERROR: No contact ID received");
}

$id = (int)$_POST['id'];

try {
    deleteContact($pdo, $id);
    header('Location: admin.php');
    exit;
} catch (PDOException $e) {
    die("ERROR: Database error - " . $e->getMessage());
}
?>