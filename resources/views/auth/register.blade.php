@extends('layout')

@section('title', 'Register')

@section('content')
    <div class="col-md-5 mx-auto surface-card">
        <h1 class="mb-4">Create Account</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-text-input name="name" label="Name" />
            <x-text-input name="email" label="Email" type="email" />
            <x-text-input name="password" label="Password" type="password" />
            <x-text-input name="password_confirmation" label="Confirm Password" type="password" />

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 mb-0 text-muted-slate">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>
    </div>
@endsection
