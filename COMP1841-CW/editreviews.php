<?php
include 'includes/DatabaseConnection.php';

if (isset($_POST['reviewtext'])) {
    try {
        $imageName = $_POST['existing_image'];
        if (!empty($_FILES['reviewimage']['name'])) {
            $imageName = basename($_FILES['reviewimage']['name']);
            $targetPath = 'images/' . $imageName;
            move_uploaded_file($_FILES['reviewimage']['tmp_name'], $targetPath);
        }

        $sql = 'UPDATE review SET
                reviewtext = :reviewtext,
                image = :image,
                userid = :userid,
                filmid = :filmid
                WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':reviewtext', $_POST['reviewtext']);
        $stmt->bindValue(':image', $imageName);
        $stmt->bindValue(':userid', $_POST['userid']);
        $stmt->bindValue(':filmid', $_POST['filmid']);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header('Location: reviews.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $stmt = $pdo->prepare('SELECT * FROM review WHERE id = :id');
    $stmt->execute(['id' => $_GET['id'] ?? $_POST['id']]);
    $review = $stmt->fetch();

    $users = $pdo->query('SELECT id, name FROM user');
    $films = $pdo->query('SELECT id, name FROM film');

    $title = "Edit review";
    ob_start();
    include 'templates/editreview.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';