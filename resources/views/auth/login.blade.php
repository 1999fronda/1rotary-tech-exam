@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <h2>Project Tracker System</h2>
        <h3 class="mt-4">Login</h3>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
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
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p class="mt-3">Don't have an account yet? <a href="{{ route('register.show') }}"
                class="text-decoration-none">Register</a></p>
    </form>
@endsection
