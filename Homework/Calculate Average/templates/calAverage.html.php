<?php
if (!isset($_POST['input1'])) {
    include 'templates/form.html.php';
} else {
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];
    $result = ($input1 * $input2)/2;
    $output = 'Area = ' .
        htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
    include 'templates/result.html.php';
}
?>
