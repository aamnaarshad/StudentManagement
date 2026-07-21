<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($studentId),
            ],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'photo' => ['nullable', 'image', 'max:2048'],

            'courses' => ['required', 'array', 'min:1'],
            'courses.*.name' => ['required', 'string', 'max:255'],
            'courses.*.code' => ['required', 'string', 'max:50'],
            'courses.*.credit_hours' => ['required', 'integer', 'min:1', 'max:6'],
        ];
    }
}
