<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

$isLoggedIn = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$isAdmin    = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userId     = $_SESSION['user_id'] ?? 0;

// Nếu chưa login → đẩy về login
if (!$isLoggedIn) {
    header("Location: Login.html");
    exit;
}

if (isset($_POST['reviewtext'])) {
    // ==================== PHẦN UPDATE ====================
    $id = (int)$_POST['id'];

    // Lấy review để kiểm tra quyền
    $review = getReview($pdo, $id);

    if (!$review) {
        $title = 'Error';
        $output = 'Review not exist!';
    } 
    elseif (!$isAdmin && $review['userid'] != $userId) {
        $title = 'Error';
        $output = '❌You are not allowed to edit this review! You can only edit your own reviews.';
    } 
    else {
        try {
            $imageName = $_POST['existing_image'] ?? '';
            if (!empty($_FILES['reviewimage']['name'])) {
                $imageName = basename($_FILES['reviewimage']['name']);
                move_uploaded_file($_FILES['reviewimage']['tmp_name'], 'images/' . $imageName);
            }

            updateReview($pdo, $id, $_POST['reviewtext'], $imageName, $_POST['userid'], $_POST['filmid']);
            header('Location: reviews.php');
            exit;
        } catch (PDOException $e) {
            $title = 'Error';
            $output = 'Unable to update review: ' . $e->getMessage();
        }
    }
} 
else {
    // ==================== PHẦN HIỂN THỊ FORM ====================
    $id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
    $review = getReview($pdo, $id);

    if (!$review) {
        $title = 'Error';
        $output = 'Review không tồn tại!';
    } 
    elseif (!$isAdmin && $review['userid'] != $userId) {
        $title = 'Error';
        $output = '❌ You are not allowed to edit this review! You can only edit your own reviews.';
    } 
    else {
        $users = allUsers($pdo);
        $films = allFilms($pdo);

        $title = 'Edit Review';
        ob_start();
        include 'templates/editreviews.html.php';
        $output = ob_get_clean();
    }
}

include 'templates/layout.html.php';
?>