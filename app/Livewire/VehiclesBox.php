<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VehiclesBox extends Component
{
    public Collection $vehicles;
    public Collection $users;

    public ?string $selected_user_id = null;

    public string $user_id;

    public function mount()
    {
        $this->users = User::whereNot([
            ['is_admin', 1]
        ])->get();
        $this->user_id = Auth::id();
    }

    public function render()
    {
        if (Auth::user()->is_admin) {
            if ($this->selected_user_id) {
                $this->vehicles = Vehicle::where([
                    ['user_id', $this->selected_user_id],
                ])->with(['user'])
                    ->get();
            } else {
                $this->vehicles = Vehicle::with(['user'])
                    ->get();
            }
        } else {
            $this->vehicles = Vehicle::where([
                ['user_id', $this->user_id]
            ])->get();
        }

        return view('livewire.vehicles-box');
    }
}
