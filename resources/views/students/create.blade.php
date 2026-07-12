@extends('layout')

@section('title', 'Register Student')

@section('content')
    <h1 class="mb-4">Student Registration</h1>

    <form method="POST" action="{{ route('students.store') }}" class="col-md-6">
        @csrf
        <x-text-input name="name" label="Name" />
        <x-text-input name="email" label="Email" type="email" />
        <x-text-input name="course" label="Course" />
        <x-text-input name="age" label="Age" type="number" />

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection