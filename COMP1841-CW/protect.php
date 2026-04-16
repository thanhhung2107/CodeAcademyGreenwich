<?php
session_start();

$uri = $_SERVER['REQUEST_URI'];


if (strpos($uri, '/admin/') !== 0) {
    if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
        header("Location: admin/Login.html");
        exit;
    }
}
?>