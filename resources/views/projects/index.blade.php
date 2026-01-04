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
    <div class="bg-success">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem maiores aut obcaecati ullam
        voluptatum rerum dolorum porro error eum id nobis ea, doloribus voluptatibus culpa, minima libero quibusdam
        similique assumenda.
    </div>

    @include('projects.create-modal')
@endsection

@push('scripts')
    @vite('resources/js/projects/create.js')
@endpush