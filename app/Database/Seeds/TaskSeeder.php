<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $today     = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $tomorrow  = date('Y-m-d', strtotime('+1 day'));
        $now       = date('Y-m-d H:i:s');

        $data = [
            // Yesterday's Tasks
            [
                'title'      => 'Review project specification & deliverables',
                'status'     => 'completed',
                'task_date'  => $yesterday,
                'created_at' => $now,
            ],
            [
                'title'      => 'Configure CodeIgniter 4 database connection',
                'status'     => 'completed',
                'task_date'  => $yesterday,
                'created_at' => $now,
            ],
            // Today's Tasks
            [
                'title'      => 'Execute migration scripts for tasks and users tables',
                'status'     => 'completed',
                'task_date'  => $today,
                'created_at' => $now,
            ],
            [
                'title'      => 'Implement TaskModel and UserModel query methods',
                'status'     => 'pending',
                'task_date'  => $today,
                'created_at' => $now,
            ],
            [
                'title'      => 'Build Bootstrap 5 layout header and navigation',
                'status'     => 'pending',
                'task_date'  => $today,
                'created_at' => $now,
            ],
            [
                'title'      => 'Test welcome dashboard date filtering logic',
                'status'     => 'pending',
                'task_date'  => $today,
                'created_at' => $now,
            ],
            // Tomorrow's Tasks
            [
                'title'      => 'Conduct UI responsive layout checks',
                'status'     => 'pending',
                'task_date'  => $tomorrow,
                'created_at' => $now,
            ],
            [
                'title'      => 'Prepare production deployment repository',
                'status'     => 'pending',
                'task_date'  => $tomorrow,
                'created_at' => $now,
            ],
        ];

        $this->db->table('tasks')->insertBatch($data);
    }
}