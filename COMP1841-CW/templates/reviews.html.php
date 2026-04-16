<p><?= $reviewCount ?> reviews have been submitted to the Film Review Database.</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Review Text</th>
            <th>Image</th>
            <th>User</th>
            <th>Film</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?= $review['id'] ?></td>
            <td><?= htmlspecialchars($review['reviewtext']) ?></td>
            <td>
                <?php if (!empty($review['image'])): ?>
                    <img src="images/<?= htmlspecialchars($review['image']) ?>" alt="Review image" width="80">
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($review['username']) ?></td>
            <td><?= htmlspecialchars($review['filmname']) ?></td>
            <td><?= htmlspecialchars($review['reviewdate']) ?></td>
            <td>
                <?php 
                // Chỉ cho phép Edit/Delete nếu là Admin HOẶC là chủ review
                if ($isAdmin || ($isLoggedIn && isset($review['userid']) && $review['userid'] == $_SESSION['user_id'])): 
                ?>
                    <form action="editreviews.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $review['id'] ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form action="deletereviews.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $review['id'] ?>">
                        <input type="submit" value="Delete" onclick="return confirm('');">
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>