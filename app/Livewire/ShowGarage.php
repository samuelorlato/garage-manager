<?php

namespace App\Livewire;

use App\Models\Garage;
use App\Models\Vehicle;
use Auth;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowGarage extends Component
{
    public string $id;

    public string $vehicle_license_plate;

    public Collection $vehicles;

    public Garage $garage;

    public string $user_id;

    public function mount($id)
    {
        $this->id = $id;

        $this->user_id = Auth::id();
    }

    public function save()
    {
        Vehicle::where([
            ['user_id', $this->user_id],
            ['license_plate', $this->vehicle_license_plate]
        ])->first()->update([
                    'garage_id' => $this->id,
                    'in_garage_since' => now()->format('Y-m-d')
                ]);
    }

    public function render()
    {
        $this->garage = Garage::where([
            ['user_id', $this->user_id],
            ['id', $this->id]
        ])->withCount('vehicles')->first();

        $this->vehicles = Vehicle::where([
            ['user_id', $this->user_id]
        ])->get();

        return view('livewire.show-garage');
    }
}
