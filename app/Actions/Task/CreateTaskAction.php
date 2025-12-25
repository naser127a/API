<?php

namespace App\Actions\Task;

use App\Models\Task;

class CreateTaskAction
{
    public function execute(array $data, int $userId): Task
    {
        return Task::create([
            'user_id' => $userId,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'priority' => $data['priority'] ?? 'medium',
        ]);
    }
}
