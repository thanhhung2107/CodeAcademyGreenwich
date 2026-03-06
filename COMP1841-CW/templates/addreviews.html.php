<form action="" method="post" enctype="multipart/form-data">
    <label for='reviewtext'>Type your review here:</label>
    <textarea name='reviewtext' rows='3' cols='40' required></textarea>

    <label for="userid">User:</label>
    <select name="userid" required>
        <?php foreach ($users as $user): ?>
            <option value="<?=$user['id']?>"><?=$user['name']?></option>
        <?php endforeach; ?>
    </select>

    <label for="filmid">Film:</label>
    <select name="filmid" required>
        <?php foreach ($films as $film): ?>
            <option value="<?=$film['id']?>"><?=$film['name']?></option>
        <?php endforeach; ?>
    </select>

    <label for="image">Review image:</label>
    <input type="file" name="reviewimage" accept="image/*">

    <input type="submit" value="Add Review">
</form>