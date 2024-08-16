<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGarageRequest;
use App\Http\Requests\UpdateGarageRequest;
use App\Models\Garage;
use Illuminate\Support\Facades\Auth;

class GarageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $garages = Garage::where([
                ['user_id', $user_id]
            ])->withCount('vehicles')->get();

            return view('app.home', compact('garages'));
        }
    }

    public function create()
    {
        if (Auth::check()) {
            return view('app.garage.create');
        }
    }

    public function store(StoreGarageRequest $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            Garage::create($validatedData);

            return redirect('/');
        }
    }

    public function show($id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $garage = Garage::where([
                ['user_id', $user_id],
                ['id', $id]
            ])->withCount('vehicles')->first();

            return view('app.garage.show', compact('garage'));
        }
    }

    public function edit($id, $name)
    {
        if (Auth::check()) {
            return view('app.garage.edit')->with([
                'garage_id' => $id,
                'garage_name' => $name
            ]);
        }
    }

    public function update(UpdateGarageRequest $request, $id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $validatedData = array_filter($request->validated());

            Garage::where([
                ['user_id', $user_id],
                ['id', $id]
            ])->first()->update($validatedData);

            return redirect('/');
        }
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $garage = Garage::where([
                ['user_id', $user_id],
                ['id', $id]
            ])->first();

            Garage::destroy($garage->id);

            return redirect('/');
        }
    }
}
