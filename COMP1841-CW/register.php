<?php
include 'includes/DatabaseConnection.php';

$title = 'Register - Film Review Database';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name && $email && $password) {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        
        if ($check->rowCount() > 0) {
            $error = "Email already used!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('INSERT INTO users (name, email, password, registerdate) 
                                   VALUES (?, ?, ?, NOW())');
            $stmt->execute([$name, $email, $hashedPassword]);

            $success = "Registration successful! You can now login.";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}

ob_start();
?>
<h2>Register New Account</h2>

<?php if ($success): ?>
    <p style="color:green; font-weight:bold;"><?= $success ?></p>
    <p><a href="admin/Login.html">→ Login now</a></p>
<?php else: ?>
    <?php if ($error): ?>
        <p style="color:red; font-weight:bold;"><?= $error ?></p>
    <?php endif; ?>

    <form action="register.php" method="post">
        <label>Full Name:</label><br>
        <input type="text" name="name" required style="width:100%; padding:12px; margin:8px 0;"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required style="width:100%; padding:12px; margin:8px 0;"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required style="width:100%; padding:12px; margin:8px 0;"><br><br>

        <input type="submit" value="Register">
    </form>
<?php endif; ?>

<?php
$output = ob_get_clean();
include 'templates/layout.html.php';
?>