<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Customers') ?></title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-border: #334155;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --success-bg: rgba(16, 185, 129, 0.1);
            --danger: #ef4444;
            --radius: 12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        body { background: var(--bg); color: var(--text); padding: 40px 20px; display: flex; justify-content: center; min-height: 100vh; }
        
        .container { width: 100%; max-width: 1100px; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .header h1 { font-size: 1.75rem; font-weight: 700; letter-spacing: -0.025em; }
        
        .btn {
            display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: #fff;
            padding: 10px 20px; border-radius: var(--radius); text-decoration: none; font-weight: 600;
            font-size: 0.9rem; transition: all 0.2s ease; border: none; cursor: pointer;
        }
        .btn:hover { background: var(--primary-hover); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); }
        .btn-sm { padding: 6px 12px; font-size: 0.8rem; border-radius: 8px; }
        .btn-secondary { background: var(--surface-border); color: var(--text); }
        .btn-secondary:hover { background: #475569; }
        .btn-danger { background: rgba(239, 68, 68, 0.15); color: var(--danger); }
        .btn-danger:hover { background: var(--danger); color: #fff; }

        .alert {
            padding: 14px 18px; border-radius: var(--radius); margin-bottom: 24px; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px; border: 1px solid transparent;
        }
        .alert-success { background: var(--success-bg); color: var(--success); border-color: rgba(16, 185, 129, 0.2); }

        .card { background: var(--surface); border: 1px solid var(--surface-border); border-radius: var(--radius); overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3); }
        
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem; }
        th { background: rgba(15, 23, 42, 0.6); padding: 16px 20px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; border-bottom: 1px solid var(--surface-border); }
        td { padding: 16px 20px; border-bottom: 1px solid var(--surface-border); color: var(--text); }
        tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: rgba(255, 255, 255, 0.02); }

        .badge { background: rgba(99, 102, 241, 0.15); color: var(--primary); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; }
        .actions { display: flex; gap: 8px; }
        .empty { text-align: center; padding: 48px; color: var(--text-muted); font-size: 0.95rem; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1><?= esc($title ?? 'Customer Directory') ?></h1>
        <a href="<?= base_url('customers/new') ?>" class="btn">+ Add Customer</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            ✓ <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($customers) && is_array($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><span class="badge">#<?= esc($customer['id']) ?></span></td>
                                <td><strong><?= esc($customer['full_name']) ?></strong></td>
                                <td><?= esc($customer['email']) ?></td>
                                <td><?= esc($customer['phone']) ?></td>
                                <td><?= esc($customer['address'] ?? 'N/A') ?></td>
                                <td>
                                    <div class="actions">
                                        <a href="<?= base_url('customers/' . $customer['id'] . '/edit') ?>" class="btn btn-sm btn-secondary">Edit</a>
                                        <a href="<?= base_url('customers/' . $customer['id'] . '/delete') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this customer?');">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty">No customer records found. Click "+ Add Customer" to create one.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>