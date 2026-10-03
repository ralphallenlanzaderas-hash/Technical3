<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    protected TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    /**
     * Welcome Page (/) - Display tasks scheduled for today.
     */
    public function today()
    {
        $data = [
            'pageTitle'   => "Today's Tasks",
            'currentDate' => date('F j, Y'),
            'tasks'       => $this->taskModel->getTodayTasks(),
        ];

        return view('welcome', $data);
    }

    /**
     * Task List Page (/tasks) - Display all tasks ordered chronologically.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'All Tasks Listing',
            'tasks'     => $this->taskModel->getAllTasksOrdered(),
        ];

        return view('tasks/index', $data);
    }
}