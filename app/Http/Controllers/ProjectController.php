<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
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
}
