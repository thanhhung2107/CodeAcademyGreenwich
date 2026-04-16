<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    deleteUser($pdo, $_POST['id']);
    header('Location: users.php');
    exit;
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Unable to delete user: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>