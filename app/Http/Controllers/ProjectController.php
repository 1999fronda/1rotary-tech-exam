<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // I usually use eloquent for small data
        // and query builder for large data

        // for mysql join demonstration
        $projects = DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.user_id')
            ->where('users.id', $user->id)
            ->select('projects.id', 'projects.name', 'projects.description', 'projects.created_at')
            ->get();

        return view('projects.index', ['projects' => $projects]);
    }

    // Create a project
    public function store(Request $request)
    {
        try {
            $project = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $request->user()->projects()->create($project);

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            Log::error("Error creating a project", ['error' => $th->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Project creation failed. Name may already exist.'
            ], 500);
        }
    }

    public function edit(Project $project)
    {
        // Check if logged in user owns the project
        if ($project->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not allowed to edit this project.'
            ], 403);
        }

        return response()->json($project);
    }

    public function update(Request $request, Project $project)
    {
        try {
            // Check if logged in user owns the project
            if ($project->user_id !== $request->user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not allowed to update this project.'
                ], 403);
            }

            $request->validate(
                [
                    'editName' => 'required|string|max:255',
                    'editDescription' => 'nullable|string',
                ],
                [
                    'editName.required' => 'Project name is required.',
                    'editName.max' => 'Project name must not exceed 255 characters.',
                ]
            );

            $project->update([
                'name' => $request['editName'],
                'description' => $request['editDescription'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            Log::error('Error updating project', [
                'error' => $th->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Project update failed.'
            ], 500);
        }
    }


    public function destroy(Project $project)
    {
        // Check if logged in user owns the project
        if ($project->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not allowed to delete this project.'
            ], 403);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully!'
        ]);
    }
}
