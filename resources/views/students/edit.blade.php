@extends('layout')

@section('title', 'Edit Student')

@section('content')
    <h1 class="mb-4">Edit Student</h1>

    <form method="POST" action="{{ route('students.update', $student) }}" class="col-md-6 surface-card">
        @csrf
        @method('PUT')
        <x-text-input name="name" label="Name" :value="$student->name" />
        <x-text-input name="email" label="Email" type="email" :value="$student->email" />
        <x-text-input name="course" label="Course" :value="$student->course" />
        <x-text-input name="age" label="Age" type="number" :value="$student->age" />

        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection