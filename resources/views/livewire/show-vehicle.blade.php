<div>
    <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-6xl mt-4">
        <div class="flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Seeing vehicle {{ $vehicle->license_plate }}
            </p>
            <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                href="/" wire:navigate>Back</a>
        </div>
        <div class="mt-4">
            <div class="flex flex-col justify-between items-start">
                @if (Auth::user()->is_admin)
                    <div>User email: {{ $vehicle->user->email }}</div>
                    <div>User name: {{ $vehicle->user->name }}</div>
                @endif
                @if ($vehicle->in_garage_since)
                    <div>In garage {{ $vehicle->garage->name }} since:
                        {{ \Carbon\Carbon::parse($vehicle->in_garage_since)->format('d/m/y') }}
                    </div>
                @endif
                <div>Model: {{ $vehicle->model }}</div>
                <div>Brand: {{ $vehicle->brand }}</div>
                <div>Year: {{ $vehicle->year }}</div>
                <div>Color: {{ $vehicle->color }}</div>
            </div>
        </div>
    </div>
</div>