<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Accounts</title>
</head>
<body>
    <h2>User Accounts</h2>
    <p><a href="<?= base_url('users/new') ?>">+ Add New User</a> | <a href="<?= base_url('customers') ?>">Manage Customers</a></p>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green; font-weight: bold;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (! empty($users)): ?>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td align="center">
                            <?php if (! empty($u['avatar']) && file_exists(FCPATH . 'uploads/avatars/' . $u['avatar'])): ?>
                                <img src="<?= base_url('uploads/avatars/' . $u['avatar']) ?>" alt="Avatar" width="48" height="48" style="border-radius: 50%; object-fit: cover;">
                            <?php else: ?>
                                <div style="width:48px; height:48px; border-radius:50%; background:#2b6cb0; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:18px;">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($u['username']) ?></td>
                        <td><?= esc($u['full_name']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc(ucfirst($u['role'])) ?></td>
                        <td><a href="<?= base_url('users/' . $u['id'] . '/edit') ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>