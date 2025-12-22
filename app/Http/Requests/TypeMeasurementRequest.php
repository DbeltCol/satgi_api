<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeMeasurementRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:type_measurements,name,'.optional($this->route('type_measurement'))->id,
            'symbol' => 'required|string|max:255|unique:type_measurements,symbol,'.optional($this->route('type_measurement'))->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('default.name.required'),
            'name.string' => __('default.name.string'),
            'name.max' => __('default.name.max'),
            'name.unique' => __('default.name.unique'),
            'symbol.required' => __('default.symbol.required'),
            'symbol.string' => __('default.symbol.string'),
            'symbol.max' => __('default.symbol.max'),
            'symbol.unique' => __('default.symbol.unique'),
        ];
    }
}
