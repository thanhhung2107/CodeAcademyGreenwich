<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (isset($_POST['name']) && isset($_POST['email'])) {
    try {
        insertUser($pdo, $_POST['name'], $_POST['email']);
        header('Location: users.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to add user: ' . $e->getMessage();
    }
} else {
    $title = 'Add User';
    ob_start();
    include 'templates/addusers.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>