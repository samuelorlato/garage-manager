<?php

namespace App\Livewire;

use App\Http\Requests\UpdateGarageRequest;
use App\Models\Garage;
use Auth;
use Livewire\Component;

class EditGarage extends Component
{
    public string $id;

    public string $name;
    public string $address;
    public int $capacity;

    public Garage $garage;

    public string $user_id;

    public function mount($id)
    {
        $this->id = $id;

        $this->user_id = Auth::id();
    }

    public function update()
    {
        $validated = $this->validate();

        if ($this->capacity < $this->garage->vehicles()->count()) {
            $this->addError('capacity', 'The capacity cannot be less than the number of vehicles already in the garage.');
            return;
        }

        Garage::where([
            ['user_id', $this->user_id],
            ['id', $this->id],
        ])->first()->update($validated);

        return redirect()->to('/');
    }

    protected function rules(): array
    {
        return (new UpdateGarageRequest())->rules();
    }

    public function delete()
    {
        $garage = Garage::where([
            ['user_id', $this->user_id],
            ['id', $this->id]
        ])->first();

        $garage->vehicles()->update([
            'garage_id' => null,
            'in_garage_since' => null
        ]);

        Garage::destroy($garage->id);

        return redirect()->to('/');
    }

    public function render()
    {
        $this->garage = Garage::where([
            ['user_id', $this->user_id],
            ['id', $this->id]
        ])->first();

        $this->name = $this->garage->name;
        $this->address = $this->garage->address;
        $this->capacity = $this->garage->capacity;

        return view('livewire.edit-garage');
    }
}
