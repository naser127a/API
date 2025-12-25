<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->create(
            $request->validated(),
            auth()->id()
        );

        return new TaskResource($task);
    }
}
