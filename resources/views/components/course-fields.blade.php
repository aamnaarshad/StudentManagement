@props(['courses' => collect()])

<div class="mb-3">
    <label class="form-label">Courses</label>

    <div id="course-fields">
        @forelse ($courses as $index => $course)
            <div class="course-row mb-2">
                <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small">Course Name</label>
                        <input type="text" name="courses[{{ $index }}][name]" value="{{ $course->name }}" class="form-control" placeholder="Course name" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Course Code</label>
                        <input type="text" name="courses[{{ $index }}][code]" value="{{ $course->course_code }}" class="form-control" placeholder="e.g. CS101" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Credit Hrs</label>
                        <input type="number" name="courses[{{ $index }}][credit_hours]" value="{{ $course->credit_hours }}" class="form-control" min="1" max="6" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-secondary w-100 remove-course">Remove</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="course-row mb-2">
                <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small">Course Name</label>
                        <input type="text" name="courses[0][name]" value="{{ old('courses.0.name') }}" class="form-control" placeholder="Course name" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Course Code</label>
                        <input type="text" name="courses[0][code]" value="{{ old('courses.0.code') }}" class="form-control" placeholder="e.g. CS101" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Credit Hrs</label>
                        <input type="number" name="courses[0][credit_hours]" value="{{ old('courses.0.credit_hours') }}" class="form-control" min="1" max="6" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-secondary w-100 remove-course">Remove</button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <button type="button" id="add-course" class="btn btn-sm btn-outline-primary mt-1">+ Add another course</button>

    @error('courses')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('course-fields');
        const addBtn = document.getElementById('add-course');
        let courseIndex = container.querySelectorAll('.course-row').length;

        addBtn.addEventListener('click', function () {
            const row = document.createElement('div');
            row.className = 'course-row mb-2';
            row.innerHTML = `
                <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small">Course Name</label>
                        <input type="text" name="courses[${courseIndex}][name]" class="form-control" placeholder="Course name" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Course Code</label>
                        <input type="text" name="courses[${courseIndex}][code]" class="form-control" placeholder="e.g. CS101" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Credit Hrs</label>
                        <input type="number" name="courses[${courseIndex}][credit_hours]" class="form-control" min="1" max="6" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-secondary w-100 remove-course">Remove</button>
                    </div>
                </div>
            `;
            container.appendChild(row);
            courseIndex++;
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-course')) {
                const rows = container.querySelectorAll('.course-row');
                if (rows.length > 1) {
                    e.target.closest('.course-row').remove();
                }
            }
        });
    });
</script>
