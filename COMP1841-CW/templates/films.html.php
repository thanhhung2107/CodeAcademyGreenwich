<p><?= count($films) ?> films have been submitted to the Film Review Database.</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Film Name</th>
            <th>Date Added</th>
            <?php if ($isAdmin): ?>   <!-- Chỉ Admin mới thấy cột Actions -->
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($films as $film): ?>
        <tr>
            <td><?= $film['id'] ?></td>
            <td><?= htmlspecialchars($film['name']) ?></td>
            <td><?= htmlspecialchars($film['created_at']) ?></td>
            
            <?php if ($isAdmin): ?>
                <td>
                    <form action="editfilms.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form action="deletefilms.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this movie?');">
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
