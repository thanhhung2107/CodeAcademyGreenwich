<?php foreach($users as $user): ?>
<blockquote>
<p>
Name: <?=htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8')?><br>
Email: <?=htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8')?>
</p>

<form action="deleteuser.php" method="post">
<input type="hidden" name="id" value="<?=$user['id']?>">
<input type="submit" value="Delete">
</form>

<form action="edituser.php" method="post">
<input type="hidden" name="id" value="<?=$user['id']?>">
<input type="submit" value="Edit">
</form>
</blockquote>
<?php endforeach; ?>