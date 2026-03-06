<?php
if (isset($_POST['name'])) {
    try {
        include 'includes/DatabaseConnection.php';

        $sql = 'INSERT INTO user SET name = :name, email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $_POST['name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();

        header('Location: users.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $title = "Add a new user";
    ob_start();
    include 'templates/adduser.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';