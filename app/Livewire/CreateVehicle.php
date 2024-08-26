<?php

namespace App\Livewire;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Garage;
use App\Models\Vehicle;
use Auth;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateVehicle extends Component
{
    public string $license_plate;
    public string $brand;
    public string $model;
    public int $year;
    public string $color;
    public ?string $garage_id = null;
    public ?string $in_garage_since = null;

    public Collection $garages;

    public string $user_id;

    public function mount()
    {
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

    public function save()
    {
        $validated = $this->validate();

        $garage = Garage::find($this->garage_id);

        if ($garage && $garage->vehicles()->count() == $garage->capacity) {
            $this->addError('garage_id', 'The garage is already full.');
        }

        Vehicle::create($validated);

        return redirect()->to('/');
    }

    protected function rules(): array
    {
        return (new StoreVehicleRequest())->rules();
    }

    public function render()
    {
        $this->garages = Garage::where([
            ['user_id', $this->user_id]
        ])->withCount('vehicles')->get();

        return view('livewire.create-vehicle');
    }
}
