<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'permissions' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('default.name.required'),
            'name.string' => __('default.name.string'),
            'name.max' => __('default.name.max'),
            'description.required' => __('default.description.required'),
            'description.string' => __('default.description.string'),
            'description.max' => __('default.description.max'),
        ];
    }
}
