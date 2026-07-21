@extends('layout')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="surface-card text-center">
                <p class="text-muted-slate mb-1">Total Students</p>
                <h2 class="mb-0">{{ $totalStudents }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="surface-card text-center">
                <p class="text-muted-slate mb-1">Total Courses</p>
                <h2 class="mb-0">{{ $totalCourses }}</h2>
            </div>
        </div>
    </div>

    <div class="surface-card">
        <h2 class="mb-3" style="font-size:1.2rem;">Recently Added Students</h2>
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr><th>Name</th><th>Email</th><th>Courses</th></tr>
            </thead>
            <tbody>
                @forelse ($recentStudents as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @forelse ($student->courses as $course)
                                <span class="badge-course">{{ $course->name }} ({{ $course->course_code }}) &middot; {{ $course->credit_hours }} cr</span>
                            @empty
                                <span class="text-muted-slate">No courses</span>
                            @endforelse
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted-slate">No students yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
