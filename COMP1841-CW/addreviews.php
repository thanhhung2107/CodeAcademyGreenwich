<?php
if(isset($_POST['reviewtext'])){
    try{
        include 'includes/DatabaseConnection.php';
        $imageName = $_FILES['reviewimage']['name'] ?? '';
        if ($imageName) {
            $targetPath = 'images/' . basename($imageName);
            move_uploaded_file($_FILES['reviewimage']['tmp_name'], $targetPath);
        }

        $sql = 'INSERT INTO review SET
                reviewtext = :reviewtext,
                reviewdate = CURDATE(),
                image = :image,
                userid = :userid,
                filmid = :filmid';
                        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':reviewtext', $_POST['reviewtext']);
        $stmt->bindValue(':image', $imageName);
        $stmt->bindValue(':userid', $_POST['userid']);
        $stmt->bindValue(':filmid', $_POST['filmid']);
        $stmt->execute();      
        header('location: reviews.php');
    } catch (PDOException $e){
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    $users = $pdo->query('SELECT id, name FROM user');
    $films = $pdo->query('SELECT id, name FROM film');

    $title = "Add a new review";
    ob_start();
    include 'templates/addreviews.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';