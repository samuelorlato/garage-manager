<?php

namespace App\Livewire;

use App\Models\Garage;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Livewire\Component;

class UsersBox extends Component
{
    public Collection $users;

    public function render()
    {
        $this->users = User::whereNot([
            ['is_admin', 1]
        ])->withCount(['garages', 'vehicles'])->get();

        return view('livewire.users-box');
    }
}
