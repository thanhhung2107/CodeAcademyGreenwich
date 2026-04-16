<?php
include 'includes/DatabaseConnection.php';

$title = 'Contact Admin';

$messageSent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($email && $message) {
        // Lưu vào database
        $stmt = $pdo->prepare('INSERT INTO contact (email, message) VALUES (:email, :message)');
        $stmt->execute(['email' => $email, 'message' => $message]);

        // Gửi email thông báo
        $to      = "Batpho17@gmail.com";
        $subject = "New Contact Message from Film Review";
        $body    = "From: $email\n\nMessage:\n$message";
        $headers = "From: no-reply@filmreview.com";
        // mail($to, $subject, $body, $headers);

        $messageSent = true;
    } else {
        $error = "Please fill in both email and message.";
    }
}

ob_start();
?>

<h2>Contact Admin</h2>

<?php if ($messageSent): ?>
    <p style="color:green; font-size:1.2rem; font-weight:bold;">
        ✅ Your message has been sent successfully!<br>
        Thank you for contacting us.
    </p>
    <p><a href="index.php" style="color:#3cbc8d;">← Back to Home</a></p>
<?php else: ?>
    <?php if ($error): ?>
        <p style="color:red; font-weight:bold;"><?= $error ?></p>
    <?php endif; ?>

    <form action="contact.php" method="post">
        <label for="email">Your Email:</label><br>
        <input type="email" name="email" id="email" required style="width:100%; padding:12px; margin:8px 0; border-radius:8px;">

        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="7" required style="width:100%; padding:12px; border-radius:8px;"></textarea>

        <br><br>
        <input type="submit" value="Send Message" style="background:#3cbc8d; color:white; padding:14px 30px; border:none; border-radius:8px; font-size:1.1rem; cursor:pointer;">
    </form>
<?php endif; ?>

<?php
$output = ob_get_clean();
include 'templates/layout.html.php';
?>