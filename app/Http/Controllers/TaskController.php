<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function store(Project $project, Request $request)
    {
        // Check if logged in user owns the project
        if ($project->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You are not allowed to add task in this project.'
            ], 403);
        }

        try {
            $task = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('tasks')
                        ->where('project_id', $project->id),
                ],
            ], [
                'name.required' => 'The task field is required.',
                'name.max' => 'Task name must not exceed 255 characters.',
                'name.unique'   => 'This task already exists in the project.',
            ]);

            $project->tasks()->create($task);

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            Log::error('Error creating task', [
                'error' => $th->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Task creation failed.'
            ], 500);
        }
    }

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
