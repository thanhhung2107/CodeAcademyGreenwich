<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

if (isset($_POST['reviewtext'])) {
    try {
        $imageName = '';
        if (!empty($_FILES['reviewimage']['name'])) {
            $imageName = basename($_FILES['reviewimage']['name']);
            move_uploaded_file($_FILES['reviewimage']['tmp_name'], 'images/' . $imageName);
        }

        // BẮT BUỘC dùng userid của người đang login (không cho chọn user khác)
        $userid = $_SESSION['user_id'] ?? 0;

        insertReview($pdo, $_POST['reviewtext'], $imageName, $userid, $_POST['filmid']);
        
        header('Location: reviews.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to add review: ' . $e->getMessage();
    }
} else {
    $users = allUsers($pdo);   // vẫn giữ để hiển thị dropdown (nhưng sẽ không dùng)
    $films = allFilms($pdo);

    $title = 'Add Review';
    ob_start();
    include 'templates/addreviews.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>