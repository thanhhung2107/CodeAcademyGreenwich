<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (isset($_POST['name'])) {
    try {
        updateFilm($pdo, $_POST['id'], $_POST['name']);
        header('Location: films.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $film = getFilm($pdo, $_GET['id'] ?? $_POST['id'] ?? 0);
    $title = "Edit film";
    ob_start();
    include 'templates/editfilms.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>