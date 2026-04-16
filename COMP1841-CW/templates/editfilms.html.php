<form action="" method="post">
    <input type="hidden" name="id" value="<?=$film['id']?>">
    <label>Film Name:</label>
    <input type="text" name="name" value="<?=htmlspecialchars($film['name'])?>" required>
    <input type="submit" value="Update">
</form>