// BRANCH 1: When user clicks "Save Changes" (POST data exists)
if (isset($_POST['name'])) {
    try {
        updateUser($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
        
        header('Location: users.php');
        exit();   // VERY IMPORTANT: Prevent code from continuing

    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Database error: ' . $e->getMessage();
    }
} 
// BRANCH 2: When user first clicks "Edit" button from the list
else {
    $id = $_POST['id'] ?? $_GET['id'] ?? 0;
    $user = getUser($pdo, $id); 
    
    $title = 'Edit User';

    ob_start();
    include 'templates/editusers.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
