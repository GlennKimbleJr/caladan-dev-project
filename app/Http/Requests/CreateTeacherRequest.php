<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'school' => 'required|string',
            'grades' => ['nullable', 'array', Rule::in(Teacher::getAvailableGrades())],
            'subjects' => ['nullable', 'array', Rule::in(Teacher::getAvailableSubjects())],
            'profile_photo' => 'nullable|file|image'
        ];
    }
}
