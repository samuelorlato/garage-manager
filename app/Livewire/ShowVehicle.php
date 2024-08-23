<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Auth;
use Livewire\Component;

class ShowVehicle extends Component
{
    public string $license_plate;

    public Vehicle $vehicle;

    public string $user_id;

    public function mount($license_plate)
    {
        $this->license_plate = $license_plate;

        $this->user_id = Auth::id();
    }

    public function render()
    {
        $this->vehicle = Vehicle::where([
            ['user_id', $this->user_id],
            ['license_plate', $this->license_plate]
        ])->first();

        return view('livewire.show-vehicle');
    }
}
