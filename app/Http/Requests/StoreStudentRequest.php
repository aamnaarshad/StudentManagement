<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email,' . $this->student?->id,
            'course' => 'required|string|max:255',
            'age'    => 'required|integer|min:16|max:100',
        ];
    }
}