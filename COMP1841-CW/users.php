<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    include 'includes/DatabaseConnection.php';

    $sql = 'SELECT id, name, email FROM user';
    $users = $pdo->query($sql);

    $title = 'Users List';

    ob_start();
    include 'templates/users.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';