<?php

namespace App\Http\Requests;

use App\Models\Garage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVehicleRequest extends FormRequest
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
            'garage_id' => $this->route('garage_id'),
            'user_id' => Auth::id(),
            'in_garage_since' => now()->format('Y-m-d'),
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
            'license_plate' => ['required', 'string', 'regex:/^([A-Z]{3}[0-9]{4})$|^([A-Z]{3}[0-9][A-Z][0-9]{2})$/', 'unique:vehicles,license_plate'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'color' => ['required', 'string'],
            'garage_id' => ['required', 'uuid', 'exists:garages,id'],
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'in_garage_since' => ['required', 'date']
        ];
    }


    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $garage = Garage::find($this->garage_id);

            if ($garage && $garage->vehicles()->count() == $garage->capacity) {
                $validator->errors()->add('garage_id', 'The garage is already full.');
            }
        });
    }
}
