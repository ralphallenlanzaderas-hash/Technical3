<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'status', 'task_date', 'created_at'];

    /**
     * Retrieve all tasks assigned for today's date.
     *
     * @return array
     */
    public function getTodayTasks(): array
    {
        $today = date('Y-m-d');
        return $this->where('task_date', $today)
                    ->orderBy('status', 'ASC')
                    ->findAll();
    }

    /**
     * Retrieve all tasks ordered chronologically by task date.
     *
     * @return array
     */
    public function getAllTasksOrdered(): array
    {
        return $this->orderBy('task_date', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }
}