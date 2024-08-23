<?php

namespace App\Livewire;

use App\Http\Requests\StoreGarageRequest;
use App\Models\Garage;
use Auth;
use Livewire\Component;

class CreateGarage extends Component
{
    public string $name;
    public string $address;
    public int $capacity;

    public string $user_id;

    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function save()
    {
        $validated = $this->validate();

        Garage::create($validated);

        return redirect()->to('/');
    }

    protected function rules(): array
    {
        return (new StoreGarageRequest())->rules();
    }

    public function render()
    {
        return view('livewire.create-garage');
    }
}
