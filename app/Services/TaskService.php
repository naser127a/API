<?php

namespace App\Services;

use App\Actions\Task\CreateTaskAction;
use App\Models\Task;
use App\Events\TaskCreated;

class TaskService
{
    public function __construct(
        protected CreateTaskAction $createTask
    ) {}

    public function create(array $data, int $userId): Task
    {
        $task = $this->createTask->execute($data, $userId);

        event(new TaskCreated($task));

        return $task;
    }
}
