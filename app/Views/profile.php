<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <i class="bi bi-person-circle display-3 mb-2 d-block"></i>
                <h4 class="fw-bold mb-0"><?= esc($user['full_name'] ?? 'Demo User') ?></h4>
                <small class="text-white-50">@<?= esc($user['username'] ?? 'username') ?></small>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($user)): ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="bi bi-hash me-2"></i>User ID</span>
                            <span class="fw-bold">#<?= esc($user['id']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="bi bi-person me-2"></i>Username</span>
                            <span class="fw-bold"><?= esc($user['username']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="bi bi-card-heading me-2"></i>Full Name</span>
                            <span class="fw-bold"><?= esc($user['full_name']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="bi bi-envelope me-2"></i>Email Address</span>
                            <span class="fw-bold text-primary"><?= esc($user['email']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="bi bi-clock-history me-2"></i>Member Since</span>
                            <span class="fw-bold"><?= date('F j, Y', strtotime($user['created_at'])) ?></span>
                        </li>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-warning mb-0 text-center">
                        <i class="bi bi-exclamation-triangle me-2"></i>No demo user record found. Please execute the database seeder.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>