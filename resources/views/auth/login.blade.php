@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="col-md-5 mx-auto surface-card">
        <h1 class="mb-4">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <x-text-input name="email" label="Email" type="email" />
            <x-text-input name="password" label="Password" type="password" />

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 mb-0 text-muted-slate">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
@endsection
