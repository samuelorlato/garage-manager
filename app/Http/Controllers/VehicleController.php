<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function create($garage_id)
    {
        if (Auth::check()) {
            return view('app.vehicle.create')->with([
                'garage_id' => $garage_id
            ]);
        }
    }

    public function store(StoreVehicleRequest $request, $garage_id)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            Vehicle::create($validatedData);

            return redirect("/garage/$garage_id");
        }
    }

    public function show($license_plate)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $vehicle = Vehicle::where([
                ['user_id', $user_id],
                ['license_plate', $license_plate]
            ])->first();

            return view('app.vehicle.show', compact('vehicle'));
        }
    }

    public function edit($garage_id, $license_plate)
    {
        if (Auth::check()) {
            return view('app.vehicle.edit')->with([
                'garage_id' => $garage_id,
                'license_plate' => $license_plate
            ]);
        }
    }

    public function update(UpdateVehicleRequest $request, $garage_id, $license_plate)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $validatedData = array_filter($request->validated());

            Vehicle::where([
                ['user_id', $user_id],
                ['license_plate', $license_plate],
                ['garage_id', $garage_id]
            ])->first()->update($validatedData);

            return redirect("/garage/$garage_id");
        }
    }

    public function destroy($garage_id, $license_plate)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $vehicle = Vehicle::where([
                ['user_id', $user_id],
                ['license_plate', $license_plate]
            ])->first();

            Vehicle::destroy($vehicle->license_plate);

            return redirect("/garage/$garage_id");
        }
    }
}
