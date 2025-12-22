<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorMeasurementRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'measurement' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('default.code.required'),
            'code.string' => __('default.code.string'),
            'code.max' => __('default.code.max'),
            'measurement.required' => __('default.measurement.required'),
            'measurement.numeric' => __('default.measurement.numeric'),
        ];
    }
}
