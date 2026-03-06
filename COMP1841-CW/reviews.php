<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    include 'includes/DatabaseConnection.php';

    $sql = 'SELECT review.id, reviewtext, user.name, user.email, film.name AS filmname, image
            FROM review
            INNER JOIN user ON userid = user.id
            INNER JOIN film ON filmid = film.id';

    $reviews = $pdo->query($sql);

    $title = 'Reviews List';

    ob_start();
    include 'templates/reviews.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';