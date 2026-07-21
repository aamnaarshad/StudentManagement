<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ route('home') }}">Student Management</a>
        <div class="d-flex align-items-center">
            <a class="nav-link d-inline text-white" href="{{ route('home') }}">Home</a>
            @auth
                <a class="nav-link d-inline text-white" href="{{ route('students.index') }}">Students</a>
            @endauth
            <a class="nav-link d-inline text-white" href="{{ route('about') }}">About</a>

            @auth
                @if (auth()->user()->isAdmin())
                    <a class="nav-link d-inline text-white" href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <span class="nav-link d-inline text-white">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
                </form>
            @else
                <a class="nav-link d-inline text-white" href="{{ route('login') }}">Login</a>
                <a class="nav-link d-inline text-white" href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
