<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-list-task text-primary me-2"></i>All Tasks Listing</h2>
        <p class="text-muted mb-0">Complete chronological record of all system tasks</p>
    </div>
    <span class="badge bg-primary fs-6 px-3 py-2">Total Tasks: <?= count($tasks) ?></span>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <?php if (!empty($tasks)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 70px;" class="text-center">ID</th>
                            <th>Task Title</th>
                            <th style="width: 180px;" class="text-center">Task Date</th>
                            <th style="width: 150px;" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <?php 
                                $isCompleted = strtolower($task['status']) === 'completed'; 
                                $isToday     = $task['task_date'] === date('Y-m-d');
                            ?>
                            <tr class="<?= $isCompleted ? 'task-row-completed' : 'task-row-pending' ?>">
                                <td class="text-center text-muted fw-bold">#<?= esc($task['id']) ?></td>
                                <td>
                                    <span class="<?= $isCompleted ? 'completed-title' : 'fw-semibold text-dark' ?>">
                                        <?= esc($task['title']) ?>
                                    </span>
                                    <?php if ($isToday): ?>
                                        <span class="badge bg-info text-dark ms-2">Today</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center text-muted">
                                    <i class="bi bi-calendar-event me-1"></i><?= date('M d, Y', strtotime($task['task_date'])) ?>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <p class="text-muted">No task records found in the database.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>