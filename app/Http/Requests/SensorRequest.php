<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorRequest extends FormRequest
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
            'type_sensor_id' => 'required|exists:type_sensors,id',
            'type_measurement_id' => 'required|exists:type_measurements,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('default.name.required'),
            'name.string' => __('default.name.string'),
            'name.max' => __('default.name.max'),
            'type_sensor_id.required' => __('default.type_sensor_id.required'),
            'type_sensor_id.exists' => __('default.type_sensor_id.exists'),
            'type_measurement_id.required' => __('default.type_measurement_id.required'),
            'type_measurement_id.exists' => __('default.type_measurement_id.exists'),
        ];
    }
}
