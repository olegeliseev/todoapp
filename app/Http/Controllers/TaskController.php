<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        return Task::create($request->all());
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|required|string',
            'completed' => 'sometimes|required|boolean'
        ]);

        $task->update($request->only(['title', 'completed']));
        return $task;
    }
}
