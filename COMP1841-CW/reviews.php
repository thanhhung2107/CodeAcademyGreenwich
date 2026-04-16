<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

// Định nghĩa 2 biến quan trọng
$isLoggedIn = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$isAdmin    = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

try {
    $reviews = allReviews($pdo);          
    $reviewCount = count($reviews);       

    $title = 'Reviews List';
    ob_start();
    include 'templates/reviews.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>