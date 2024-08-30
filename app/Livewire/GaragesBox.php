<?php

namespace App\Livewire;

use App\Models\Garage;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GaragesBox extends Component
{
    public Collection $garages;
    public Collection $users;

    public ?string $selected_user_id = null;

    public $user_id;

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
                $this->garages = Garage::where([
                    ['user_id', $this->selected_user_id],
                ])->with(['user'])
                    ->withCount('vehicles')->get();
            } else {
                $this->garages = Garage::with(['user'])
                    ->withCount('vehicles')->get();
            }
        } else {
            $this->garages = Garage::where([
                ['user_id', $this->user_id]
            ])->withCount('vehicles')->get();
        }

        return view('livewire.garages-box');
    }
}
