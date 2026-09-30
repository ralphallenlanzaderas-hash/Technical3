<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Edit Customer') ?></title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-border: #334155;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --danger: #ef4444;
            --radius: 12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        body { background: var(--bg); color: var(--text); padding: 40px 20px; display: flex; justify-content: center; min-height: 100vh; }
        
        .container { width: 100%; max-width: 600px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .header h1 { font-size: 1.5rem; font-weight: 700; }
        
        .card { background: var(--surface); border: 1px solid var(--surface-border); border-radius: var(--radius); padding: 32px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3); }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
        
        input, textarea {
            width: 100%; background: var(--bg); border: 1px solid var(--surface-border); border-radius: 8px;
            padding: 12px 16px; color: var(--text); font-size: 0.95rem; transition: border-color 0.2s ease; outline: none;
        }
        input:focus, textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); }
        textarea { resize: vertical; min-height: 90px; }

        .errors { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--danger); padding: 14px; border-radius: var(--radius); margin-bottom: 20px; font-size: 0.88rem; }
        .errors ul { margin-left: 20px; }

        .btn-group { display: flex; gap: 12px; justify-content: flex-end; margin-top: 28px; }
        .btn { padding: 12px 24px; border-radius: 8px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-size: 0.9rem; transition: all 0.2s; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-hover); }
        .btn-secondary { background: var(--surface-border); color: var(--text); }
        .btn-secondary:hover { background: #475569; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Edit Customer #<?= esc($customer['id']) ?></h1>
    </div>

    <div class="card">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="errors">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('customers/' . $customer['id'] . '/update') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" id="full_name" name="full_name" value="<?= old('full_name', $customer['full_name']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="<?= old('email', $customer['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="text" id="phone" name="phone" value="<?= old('phone', $customer['phone']) ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address"><?= old('address', $customer['address']) ?></textarea>
            </div>

            <div class="btn-group">
                <a href="<?= base_url('customers') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Customer</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>