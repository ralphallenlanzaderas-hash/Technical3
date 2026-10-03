<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Account</title>
</head>
<body>
    <h2>Edit User Account #<?= esc($user['id']) ?></h2>
    <p><a href="<?= base_url('users') ?>">Back to Users</a></p>

    <?php if (isset($validation)): ?>
        <div style="color: red; margin-bottom: 15px;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('users/' . $user['id'] . '/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="username">Username *:</label><br>
        <input type="text" id="username" name="username" value="<?= old('username', $user['username']) ?>"><br><br>

        <label for="full_name">Full Name *:</label><br>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name', $user['full_name']) ?>"><br><br>

        <label for="email">Email Address *:</label><br>
        <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>"><br><br>

        <label for="password">New Password (leave blank to keep current):</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="role">Role *:</label><br>
        <select id="role" name="role">
            <option value="cashier" <?= old('role', $user['role']) === 'cashier' ? 'selected' : '' ?>>Cashier</option>
            <option value="manager" <?= old('role', $user['role']) === 'manager' ? 'selected' : '' ?>>Manager</option>
            <option value="admin"   <?= old('role', $user['role']) === 'admin'   ? 'selected' : '' ?>>Admin</option>
        </select><br><br>

        <label for="avatar">Profile Avatar (JPG or PNG, max 2MB)[cite: 4]:</label><br>
        <?php if (! empty($user['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $user['avatar'])): ?>
            <div style="margin: 8px 0;">
                <img src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>" alt="Current Avatar" width="80" height="80" style="border-radius: 50%; object-fit: cover;"><br>
                <small>Current Avatar</small>
            </div>
        <?php endif; ?>
        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"><br><br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>