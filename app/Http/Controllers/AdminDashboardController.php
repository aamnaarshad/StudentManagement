<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        $recentStudents = Student::with('courses')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalStudents', 'totalCourses', 'recentStudents'));
    }
}
