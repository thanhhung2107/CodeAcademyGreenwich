<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    include 'templates/form.html.php';
} else {
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];

    if (is_numeric($input1) && is_numeric($input2)) {
        $result = max($input1, $input2);
        $output = 'Max Value = ' . $result;
        include 'templates/result.html.php';
    } else {
        $error = 'Please enter valid numbers.';
        include 'templates/error.html.php';
    }
}
?>