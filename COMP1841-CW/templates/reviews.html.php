<?php foreach($reviews as $review): ?>
<blockquote>
<p>
<?=htmlspecialchars($review['reviewtext'], ENT_QUOTES, 'UTF-8')?>

<?php if (!empty($review['image'])): ?>
    <img src="images/<?=$review['image']?>" alt="Review image" style="max-width: 200px;">
<?php endif; ?>

<br>Film: <?=htmlspecialchars($review['filmname'], ENT_QUOTES, 'UTF-8')?>

(by <a href="mailto:<?=htmlspecialchars($review['email'], ENT_QUOTES, 'UTF-8')?>">
<?=htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8')?>
</a>)
</p>

<form action="deletereview.php" method="post">
<input type="hidden" name="id" value="<?=$review['id']?>">
<input type="submit" value="Delete">
</form>

<form action="editreview.php" method="post">
<input type="hidden" name="id" value="<?=$review['id']?>">
<input type="submit" value="Edit">
</form>
</blockquote>
<?php endforeach; ?>