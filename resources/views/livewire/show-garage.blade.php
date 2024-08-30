<div>
    <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-6xl mt-4">
        <div class="flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Seeing garage {{ $garage->name }}
            </p>
            <div class="flex flex-row items-center gap-3">
                <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                    href="/" wire:navigate>Back</a>
            </div>
        </div>
        <p class="leading-6 text-black">Address: {{ $garage->address }}</p>
        <p class="leading-6 text-black">Vehicles: {{ $garage->vehicles_count }}/{{ $garage->capacity }}</p>

        @if ($garage->vehicles()->count() < $garage->capacity && !Auth::user()->is_admin)
            <div class="mt-4">
                <label for="vehicle_license_plate" class="block text-sm font-medium leading-6 text-gray-900">Add a new
                    vehicle to this
                    garage</label>
                <div>
                    <form class="flex flex-row gap-2" wire:submit="save"
                        wire:confirm="Are you sure you want to move the vehicle {{ $vehicle_license_plate }} to this garage?">
                        <select id="vehicle_license_plate" name="vehicle_license_plate"
                            wire:model.live="vehicle_license_plate"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                            required>
                            <option selected value="">None</option>
                            @foreach ($vehicles as $vehicle)
                                @if ($vehicle->garage_id != $garage->id)
                                    @if ($vehicle->garage_id)
                                        <option value="{{ $vehicle->license_plate }}">{{ $vehicle->license_plate }} (currently at garage
                                            {{ $vehicle->garage->name }})
                                        </option>
                                    @else
                                        <option value="{{ $vehicle->license_plate }}">{{ $vehicle->license_plate }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        <button type="submit"
                            class="flex justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black transition-colors">Add</button>
                    </form>
                </div>
            </div>
        @endif

        <div class="mt-4">
            <ul class="flex flex-col gap-3 max-h-96 overflow-y-auto -mx-3 px-3">
                @if ($garage->vehicles_count === 0)
                    <p>New vehicles will appear here...</p>
                @endif
                @foreach ($garage->vehicles as $vehicle)
                    <li
                        class="p-4 border rounded-md flex sm:flex-row flex-col justify-between group hover:bg-black hover:text-white transition-colors items-start">
                        <a class="flex justify-center underline font-medium leading-6 text-black group-hover:text-white transition-colors"
                            href="/vehicle/{{ $vehicle->license_plate }}">{{ $vehicle->license_plate }}</a>
                        <div class="flex sm:flex-row flex-col justify-between sm:gap-4 items-start">
                            <div>In garage since:
                                {{ \Carbon\Carbon::parse($vehicle->in_garage_since)->format('d/m/y') }}
                            </div>
                            <div>Model: {{ $vehicle->model }}</div>
                            <div>
                                @if (Auth::user()->is_admin)
                                    <p>User: {{ $garage->user->name }}</p>
                                @else
                                    <a class="flex justify-center text-sm underline font-medium leading-6 text-black group-hover:text-white transition-colors"
                                        href="/edit/vehicle/{{ $vehicle->license_plate }}">Edit</a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>