<p><?= count($users) ?> users have been registered in the Film Review Database.</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Register Date</th>
            <?php if ($isAdmin): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['registerdate']) ?></td>
            
            <?php if ($isAdmin): ?>
                <td>
                    <form action="editusers.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form action="deleteuser.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="submit" value="Delete" onclick="return confirm('Bạn chắc chắn muốn xóa user này?');">
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>