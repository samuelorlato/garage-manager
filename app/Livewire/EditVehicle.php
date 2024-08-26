<?php

namespace App\Livewire;

use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Garage;
use App\Models\Vehicle;
use Auth;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditVehicle extends Component
{
    public string $old_license_plate;

    public string $license_plate;
    public string $brand;
    public string $model;
    public int $year;
    public string $color;
    public ?string $garage_id = null;
    public ?string $in_garage_since = null;

    public Vehicle $vehicle;

    public Collection $garages;

    public string $user_id;

    public function mount($license_plate)
    {
        $this->old_license_plate = $license_plate;

        $this->user_id = Auth::id();
    }

    protected function prepareForValidation($attributes): array
    {
        if ($attributes['garage_id']) {
            $attributes['in_garage_since'] = now()->format('Y-m-d');
        } else {
            $attributes['garage_id'] = null;
            $attributes['in_garage_since'] = null;
        }

        return $attributes;
    }

    public function update()
    {
        $validated = $this->validate();

        $garage = Garage::find($this->garage_id);

        if ($garage->id !== $this->vehicle->garage_id) {
            if ($garage && $garage->vehicles()->count() == $garage->capacity) {
                $this->addError('garage_id', 'The garage is already full.');
                return;
            }
        }

        Vehicle::where([
            ['user_id', $this->user_id],
            ['license_plate', $this->old_license_plate],
        ])->first()->update($validated);

        return redirect()->to('/');
    }

    protected function rules(): array
    {
        return (new UpdateVehicleRequest())->rules();
    }

    public function delete()
    {
        $vehicle = Vehicle::where([
            ['user_id', $this->user_id],
            ['license_plate', $this->old_license_plate]
        ])->first();

        Vehicle::destroy($vehicle->license_plate);

        return redirect()->to('/');
    }

    public function render()
    {
        $this->vehicle = Vehicle::where([
            ['user_id', $this->user_id],
            ['license_plate', $this->old_license_plate]
        ])->first();

        $this->brand = $this->vehicle->brand;
        $this->model = $this->vehicle->model;
        $this->year = $this->vehicle->year;
        $this->color = $this->vehicle->color;

        if ($this->vehicle->garage_id) {
            $this->garage_id = $this->vehicle->garage_id;
        }

        $this->garages = Garage::where([
            ['user_id', $this->user_id]
        ])->withCount('vehicles')->get();

        return view('livewire.edit-vehicle');
    }
}
