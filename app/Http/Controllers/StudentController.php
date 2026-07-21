<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $students = Student::with('courses')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('courses', function ($courseQuery) use ($search) {
                            $courseQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('course_code', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $student = Student::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'age' => $validated['age'],
                'photo' => $this->storePhoto($request),
            ]);

            $this->syncCourses($student, $validated['courses']);
        });

        return redirect()->route('students.index')->with('success', 'Student registered!');
    }

    public function edit(Student $student): View
    {
        $student->load('courses');

        return view('students.edit', compact('student'));
    }

    public function update(StoreStudentRequest $request, Student $student): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request, $student) {
            $newPhotoPath = $this->storePhoto($request, $student);

            $student->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'age' => $validated['age'],
                'photo' => $newPhotoPath ?? $student->photo,
            ]);

            $this->syncCourses($student, $validated['courses']);
        });

        return redirect()->route('students.index')->with('success', 'Student updated!');
    }

    public function destroy(Student $student): RedirectResponse
    {
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted!');
    }

    /**
     * Each course entry is ['name' => ..., 'code' => ..., 'credit_hours' => ...].
     * Courses are matched/reused by course_code (the stable identifier),
     * with name and credit_hours kept up to date if they've changed.
     */
    private function syncCourses(Student $student, array $courses): void
    {
        $courseIds = collect($courses)
            ->map(function ($course) {
                return Course::updateOrCreate(
                    ['course_code' => trim($course['code'])],
                    [
                        'name' => trim($course['name']),
                        'credit_hours' => $course['credit_hours'],
                    ]
                )->id;
            })
            ->unique();

        $student->courses()->sync($courseIds);
    }

    /**
     * Store an uploaded photo, replacing the old one if editing.
     * Returns null when no new file was uploaded.
     */
    private function storePhoto(Request $request, ?Student $student = null): ?string
    {
        if (! $request->hasFile('photo')) {
            return null;
        }

        if ($student && $student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        return $request->file('photo')->store('student-photos', 'public');
    }
}
