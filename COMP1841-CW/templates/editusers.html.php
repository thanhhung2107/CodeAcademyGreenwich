<div class="edit-user-container">
    <h2>Edit User Information</h2>

    <form action="" method="POST">
        
        <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Save Changes" class="btn btn-primary">
            <a href="users.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>