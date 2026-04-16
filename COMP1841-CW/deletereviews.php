<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

$isLoggedIn = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$isAdmin    = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userId     = $_SESSION['user_id'] ?? 0;

// Redirect to login if not logged in
if (!$isLoggedIn) {
    header("Location: Login.html");
    exit;
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ERROR: No review ID received");
}

$id = (int)$_POST['id'];
$review = getReview($pdo, $id);

if (!$review) {
    die("ERROR: Review does not exist");
}

// Security check: Only admin or the review owner can delete
if (!$isAdmin && $review['userid'] != $userId) {
    die("ERROR: You can only delete your own reviews!");
}

try {
    deleteReview($pdo, $id);
    header('Location: reviews.php');
    exit;
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete review: ' . $e->getMessage();
    include 'templates/layout.html.php';
}
?>