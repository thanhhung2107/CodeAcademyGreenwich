<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

if (isset($_POST['name'])) {
    try {
        insertFilm($pdo, $_POST['name']);
        header('Location: films.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to add film: ' . $e->getMessage();
    }
} else {
    $title = 'Add Film';
    ob_start();
    include 'templates/addfilms.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>