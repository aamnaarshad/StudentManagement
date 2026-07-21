@extends('layout')

@section('title', 'Students')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Student Management</h1>
        <a href="{{ route('students.create') }}" class="btn btn-success">+ Add Student</a>
    </div>

    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="input-group" style="max-width:420px;">
            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name, email, course, or code">
            <button type="submit" class="btn btn-outline-primary">Search</button>
            @if ($search)
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
        </div>
    </form>

    <div class="surface-card">
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Photo</th><th>Name</th><th>Email</th><th>Courses</th><th>Age</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>
                            @if ($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="{{ $student->name }}" class="student-avatar">
                            @else
                                <span class="student-avatar student-avatar-placeholder">{{ strtoupper(substr($student->name, 0, 1)) }}</span>
                            @endif
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @forelse ($student->courses as $course)
                                <span class="badge-course">{{ $course->name }} ({{ $course->course_code }}) &middot; {{ $course->credit_hours }} cr</span>
                            @empty
                                <span class="text-muted-slate">No courses</span>
                            @endforelse
                        </td>
                        <td>{{ $student->age }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted-slate">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $students->links() }}
    </div>
@endsection
