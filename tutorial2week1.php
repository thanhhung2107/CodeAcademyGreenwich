<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World php</title>
</head>
<body>
  <?php
 $month=date("F");
 if ($month == "Agust") {
    echo"It's August, so it's really hot.";
 } else {
 echo"Not August, so at least not in the peak of the heat.";
}
 ?>


</body>
</html>