<?php
try{
    include 'includes/DatabaseConnection.php';

    $sql = 'DELETE FROM review WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    header('location: reviews.php');
}
catch(PDOException $e){
    $title = 'An error has occurred';
    $output = 'Unable to delete review: '. $e->getMessage();
}

include 'templates/layout.html.php';