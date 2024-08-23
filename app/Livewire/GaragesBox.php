<?php

namespace App\Livewire;

use App\Models\Garage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GaragesBox extends Component
{
    public Collection $garages;

    public $user_id;

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function render()
    {
        $this->garages = Garage::where([
            ['user_id', $this->user_id]
        ])->withCount('vehicles')->get();

        return view('livewire.garages-box');
    }
}
