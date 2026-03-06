<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$review['id']?>">
    <input type="hidden" name="existing_image" value="<?=$review['image']?>">

    <label for='reviewtext'>Edit your review:</label>
    <textarea name='reviewtext' rows='3' cols='40' required><?=$review['reviewtext']?></textarea>

    <label for="userid">User:</label>
    <select name="userid" required>
        <?php foreach ($users as $u): ?>
            <option value="<?=$u['id']?>" <?=($u['id'] == $review['userid']) ? 'selected' : ''?>><?=$u['name']?></option>
        <?php endforeach; ?>
    </select>

    <label for="filmid">Film:</label>
    <select name="filmid" required>
        <?php foreach ($films as $f): ?>
            <option value="<?=$f['id']?>" <?=($f['id'] == $review['filmid']) ? 'selected' : ''?>><?=$f['name']?></option>
        <?php endforeach; ?>
    </select>

    <label for="image">Change image (current: <?=$review['image']?>):</label>
    <input type="file" name="reviewimage" accept="image/*">

    <input type="submit" value="Update Review">
</form>