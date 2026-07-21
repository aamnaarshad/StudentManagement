@extends('layout')

@section('title', 'Register Student')

@section('content')
    <h1 class="mb-4">Student Registration</h1>

    <form method="POST" action="{{ route('students.store') }}" class="col-md-6 surface-card" enctype="multipart/form-data">
        @csrf
        <x-text-input name="name" label="Name" />
        <x-text-input name="email" label="Email" type="email" />
        <x-text-input name="age" label="Age" type="number" />

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <x-course-fields />

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
