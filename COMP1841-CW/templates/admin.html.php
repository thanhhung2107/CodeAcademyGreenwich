<h2>Contact Messages</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= $contact['id'] ?></td>
            <td>
                <strong>Email:</strong>
                <a href="mailto:<?= htmlspecialchars($contact['email']) ?>">
                    <?= htmlspecialchars($contact['email']) ?>
                </a><br>
                <strong>Message:</strong> <?= htmlspecialchars($contact['message']) ?>
            </td>
            <td>
                <form action="deletecontact.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Bạn chắc chắn muốn xóa tin nhắn này không?');">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>