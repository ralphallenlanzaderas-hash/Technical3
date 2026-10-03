<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold mb-1"><i class="bi bi-calendar-day text-primary me-2"></i>Tasks for Today</h2>
        <p class="text-muted mb-0">Showing active tasks for <strong class="text-dark"><?= esc($currentDate) ?></strong></p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="<?= site_url('tasks') ?>" class="btn btn-outline-secondary btn-sm">
            View All Scheduled Tasks <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <?php if (!empty($tasks)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;" class="text-center">#</th>
                            <th>Task Description</th>
                            <th style="width: 150px;" class="text-center">Status</th>
                            <th style="width: 180px;" class="text-center">Scheduled Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $index => $task): ?>
                            <?php $isCompleted = strtolower($task['status']) === 'completed'; ?>
                            <tr class="<?= $isCompleted ? 'task-row-completed' : 'task-row-pending' ?>">
                                <td class="text-center text-muted fw-semibold"><?= $index + 1 ?></td>
                                <td>
                                    <span class="<?= $isCompleted ? 'completed-title' : 'fw-semibold text-dark' ?>">
                                        <?= esc($task['title']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($isCompleted): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Completed
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center text-muted">
                                    <i class="bi bi-calendar3 me-1"></i><?= date('M d, Y', strtotime($task['task_date'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-clipboard-check text-muted display-4 mb-3 d-block"></i>
                <h5 class="text-secondary fw-semibold">No tasks scheduled for today</h5>
                <p class="text-muted small">All clear! Check the <a href="<?= site_url('tasks') ?>">full task listing</a> to view upcoming work.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>