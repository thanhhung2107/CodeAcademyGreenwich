<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    include 'templates/form.html.php';
} else {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];
    if (is_numeric($num1) && is_numeric($num2) && is_numeric($num3)) {
        $max = max($num1, $num2, $num3);
        $output = 'Max Value = ' . $max;
        include 'templates/result.html.php';
    } else {
        $error = 'Please enter valid numbers only.';
        include 'templates/error.html.php';
    }
}
?>
