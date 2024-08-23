<div>
    <div class="p-6 border rounded-md">
        <div class="flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Vehicles <span class="font-normal">({{ count($vehicles) }})</span>
            </p>
            <a class="flex justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black transition-colors"
                href="/new/vehicle" wire:navigate>New</a>
        </div>
        <div class="mt-4">
            <ul class="flex flex-col gap-3 max-h-96 overflow-y-auto -mx-3 px-3">
                @if (count($vehicles) === 0)
                    <p>New vehicles will appear here...</p>
                @endif
                @foreach ($vehicles as $vehicle)
                    <li wire:key="{{ $vehicle->license_plate }}"
                        class="p-4 border rounded-md flex md:flex-row flex-col justify-between group hover:bg-black hover:text-white transition-colors items-start">
                        <a class="flex justify-center underline font-medium leading-6 text-black group-hover:text-white transition-colors"
                            href="/vehicle/{{ $vehicle->license_plate }}">{{ $vehicle->license_plate }}</a>
                        <div class="flex md:flex-row flex-col justify-between md:gap-4">
                            @if ($vehicle->garage)
                                <div>Garage: {{ $vehicle->garage->name  }}</div>
                            @else
                                <div>Garage: none</div>
                            @endif
                            <div class="flex items-start">
                                <a class="flex justify-center text-sm underline font-medium leading-6 text-black group-hover:text-white transition-colors"
                                    href="/edit/vehicle/{{ $vehicle->license_plate }}" wire:navigate>Edit</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>