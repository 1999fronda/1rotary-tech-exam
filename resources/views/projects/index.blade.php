@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>My Projects</h2>
        <div>
            <button type="button" class="btn btn-dark btn-dark" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                Create Project
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table id="projectTable" class="table table-striped">
            <thead>
                <tr>
                    <th width="25%">Name</th>
                    <th width="50%">Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description ?? '' }}</td>
                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($project->created_at)->format('M d, Y h:i A') }}
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-outline-primary btn-sm">View</button>
                                <button class="btn btn-outline-primary btn-sm edit"
                                    data-url="{{ route('projects.edit', $project->id) }}">Edit</button>
                                <button class="btn btn-outline-danger btn-sm delete"
                                    data-url="{{ route('projects.destroy', $project->id) }}">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('projects.create-modal')
    @include('projects.edit-modal')
@endsection

@push('scripts')
    @vite('resources/js/projects/table.js')
    @vite('resources/js/projects/create.js')
    @vite('resources/js/projects/update.js')
    @vite('resources/js/projects/delete.js')
@endpush
