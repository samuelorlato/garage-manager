<?php

namespace App\Http\Requests;

use App\Models\Garage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateGarageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer']
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $garage = Garage::where([
                ['user_id', $this->user_id],
                ['id', $this->id]
            ])->withCount('vehicles')->first();

            $currentVehicleCount = $garage->vehicles_count;

            if ($this->capacity < $currentVehicleCount) {
                $validator->errors()->add('capacity', 'The capacity cannot be less than the number of vehicles already in the garage.');
            }
        });
    }
}
