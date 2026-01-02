@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <div>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem est quia tempora eum. Possimus corporis ducimus
        cupiditate, molestias nostrum quas commodi consequuntur ipsam perferendis beatae architecto fugit modi excepturi
        officia?
    </div>
@endsection

@push('scripts')
    @vite('resources/js/auth/register.js')
@endpush
