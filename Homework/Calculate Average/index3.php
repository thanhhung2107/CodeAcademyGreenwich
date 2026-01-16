<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    include 'templates/form.html.php';
} else {
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];
    if (is_numeric($input1) && is_numeric($input2)) {
        $result = ($input1 + $input2)/2;
        $output = 'Area = ' . $result;
        include 'templates/result.html.php';
    } else {
        $error = 'Please enter valid numbers only.';
        include 'templates/error.html.php';
    }
}
?>
