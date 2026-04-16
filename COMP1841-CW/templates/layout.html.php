<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="reviews.css?v=2026">
    <title><?=$title?></title>
</head>
<body>
    <?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $isLoggedIn = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
    $role = $_SESSION['role'] ?? 'guest';   // guest, user, admin
    ?>

    <header><h1>Film Review Database</h1></header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="reviews.php">Reviews List</a></li>
            <li><a href="films.php">Films List</a></li>

            <?php if ($role === 'user' || $role === 'admin'): ?>
                <li><a href="addreviews.php">Add New Review</a></li>
                <li><a href="addfilms.php">Add New Film</a></li>
                <li><a href="adduser.php">Add New User</a></li>
            <?php endif; ?>

            <li><a href="contact.php">Contact Admin</a></li>

            <?php if ($role === 'guest'): ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="admin/Login.html" style="background:#3cbc8d; color:white; border-radius:50px; padding:10px 22px;">🔑 Login</a></li>
            <?php else: ?>
                <li><a href="admin/Logout.php" style="color:#ff4444; font-weight:bold;">Logout</a></li>
            <?php endif; ?>

            <?php if ($role === 'admin'): ?>
                <li><a href="users.php">Users List</a></li>
                <li><a href="admin.php" style="background:#e74c3c; color:white; border-radius:50px; padding:10px 22px;">👑 Admin Panel</a></li>
            <?php endif; ?>
        </ul>
    </nav> 

    <main>
        <?=$output?>
    </main> 

    <footer>&copy; Film Review 2026</footer>
</body>
</html>