<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="reviews.css">
    <title><?=$title?></title>
</head>
<body>
    <header><h1>Film Review Database</h1></header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="reviews.php">Reviews List</a></li>
            <li><a href="addreviews.php">Add new Review</a></li>
        </ul>
    </nav> 

    <main>
        <?=$output?>
    </main> 

    <footer>&copy; Film Review 2023</footer>
</body>
</html>