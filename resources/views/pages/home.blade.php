@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="surface-card">
        <h1>Welcome to {{ $siteName }}</h1>
        <p class="text-muted-slate mb-0">This is the home page.</p>
    </div>
@endsection
