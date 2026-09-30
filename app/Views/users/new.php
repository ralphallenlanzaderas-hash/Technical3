<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New User Account</title>
</head>
<body>
    <h2>Add New User Account</h2>
    <p><a href="<?= base_url('users') ?>">Back to Users</a></p>

    <?php if (isset($validation)): ?>
        <div style="color: red; margin-bottom: 15px;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('users/create') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username *:</label><br>
        <input type="text" id="username" name="username" value="<?= old('username') ?>"><br><br>

        <label for="full_name">Full Name *:</label><br>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>"><br><br>

        <label for="email">Email Address *:</label><br>
        <input type="email" id="email" name="email" value="<?= old('email') ?>"><br><br>

        <label for="password">Password *:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="role">Role *:</label><br>
        <select id="role" name="role">
            <option value="cashier" <?= old('role') === 'cashier' ? 'selected' : '' ?>>Cashier</option>
            <option value="manager" <?= old('role') === 'manager' ? 'selected' : '' ?>>Manager</option>
            <option value="admin"   <?= old('role') === 'admin'   ? 'selected' : '' ?>>Admin</option>
        </select><br><br>

        <button type="submit">Save User</button>
    </form>
</body>
</html>