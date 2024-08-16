<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'license_plate' => ['nullable', 'string', 'regex:/^([A-Z]{3}[0-9]{4})$|^([A-Z]{3}[0-9][A-Z][0-9]{2})$/'],
            'brand' => ['nullable', 'string'],
            'model' => ['nullable', 'string'],
            'year' => ['nullable', 'integer'],
            'color' => ['nullable', 'string'],
        ];
    }
}
