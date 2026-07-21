@extends('layout')

@section('title', 'Edit Student')

@section('content')
    <h1 class="mb-4">Edit Student</h1>

    <form method="POST" action="{{ route('students.update', $student) }}" class="col-md-6 surface-card" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-text-input name="name" label="Name" :value="$student->name" />
        <x-text-input name="email" label="Email" type="email" :value="$student->email" />
        <x-text-input name="age" label="Age" type="number" :value="$student->age" />

        <div class="mb-3">
            <label class="form-label">Photo</label>
            @if ($student->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="student-avatar-preview">
                </div>
            @endif
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <x-course-fields :courses="$student->courses" />

        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection
