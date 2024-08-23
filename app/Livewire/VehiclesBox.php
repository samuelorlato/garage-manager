<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VehiclesBox extends Component
{
    public Collection $vehicles;

    public string $user_id;

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function render()
    {
        $this->vehicles = Vehicle::where([
            ['user_id', $this->user_id]
        ])->get();

        return view('livewire.vehicles-box');
    }
}
