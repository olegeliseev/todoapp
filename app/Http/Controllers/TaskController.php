<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::latest()->paginate(5);
        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate(['title' => 'required|string']);
        $task = Task::create($request->all());
        return response()->json($task);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'completed' => 'sometimes|boolean'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(['message' => 'Задача удалена']);
    }
}
