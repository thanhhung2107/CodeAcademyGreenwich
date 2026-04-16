<?php
session_start();
if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
    header("Location: Login.html");
    exit;
}

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$contacts = allContacts($pdo);

$title = 'Admin - Information Requests';
ob_start();
include 'templates/admin.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>