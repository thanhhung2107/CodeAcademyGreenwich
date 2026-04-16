<?php
session_start();

if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === true) {
    header("Location: index.php");
    exit;
} else {
    header("Location: Login.html");
    exit;
}
?>