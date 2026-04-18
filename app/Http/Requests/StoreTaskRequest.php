<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',

            'description' => 'nullable|string',

            'status'      => 'required|in:pending,in_progress,completed',

            'priority'    => 'required|integer|in:1,2,3',

            'due_date'    => 'nullable|date|after_or_equal:today',

            'is_active'   => 'nullable|boolean',
        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [
            'title.required'      => 'Task title is required.',
            'title.max'           => 'Task title may not exceed 255 characters.',

            'status.required'     => 'Please select task status.',
            'status.in'           => 'Invalid task status selected.',

            'priority.required'   => 'Please select task priority.',
            'priority.in'         => 'Invalid priority selected.',

            'due_date.date'       => 'Due date must be a valid date.',
            'due_date.after_or_equal' => 'Due date cannot be in the past.',
        ];
    }

    /**
     * Prepare Data Before Validation
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? 1 : 0,
        ]);
    }
}
