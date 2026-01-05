<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function destroy(Task $task)
    {
        // Check if logged in user owns the task
        if ($task->project->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not allowed to delete this task.'
            ], 403);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully!'
        ]);
    }
}
