@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="text-center mb-4">
        <h2>Project Tracker System</h2>
        <h3 class="mt-4">Register</h3>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="small text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="small text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" minlength="8" required>
            @error('password')
                <div class="small text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                minlength="8" required>
            @error('password_confirmation')
                <div class="small text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
        <p class="mt-3">Already have an account? <a href="{{ route('login.show') }}"
                class="text-decoration-none">Login</a></p>
    </form>
@endsection
