<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed', // Define allowed status values
        ]);

        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Task status updated successfully'], 200);
    }
}
