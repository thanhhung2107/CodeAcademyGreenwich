<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

try {
    deleteContact($pdo, $_POST['id']);
    header('Location: admin.php');
    exit;
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Unable to delete contact message: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>