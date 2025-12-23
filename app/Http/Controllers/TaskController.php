<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    //
    public function store(Request $request)
    {
        //
    }
    public function update(TaskRequest $request, Task $task)
    {
        //
        $this->authorize('update', $task);

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task updated successfully'
        ]);
    }
    public function destroy(Request $request, $id)
    {
        //
    }
    public function show($id)
    {
        //
    }
}
