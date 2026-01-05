@extends('layouts.app')

@section('title', 'Project')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $project->name }}</h3>
            <p class="card-text">{{ $project->description ?? 'No description' }}</p>
            <small class="text-muted">Created at: {{ $project->created_at->format('M d, Y') }}</small>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">Tasks</span>
                <button type="button" class="btn btn-dark btn-dark" data-bs-toggle="modal"
                    data-bs-target="#createTaskModal">
                    Create Task
                </button>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="taskTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="50%">Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($project->tasks ?? [] as $task)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $task->name }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($task->status) {
                                            'pending' => 'secondary',
                                            'in progress' => 'primary',
                                            'completed' => 'success',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    {{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y h:i A') }}
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-outline-primary btn-sm disabled">View</button>
                                        <button class="btn btn-outline-primary btn-sm disabled edit">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm delete"
                                            data-url="{{ route('tasks.destroy', $task->id) }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('projects.tasks.create-modal')
@endsection

@push('scripts')
    @vite('resources/js/projects/tasks/table.js')
    @vite('resources/js/projects/tasks/create.js')
    @vite('resources/js/projects/tasks/delete.js')
@endpush
