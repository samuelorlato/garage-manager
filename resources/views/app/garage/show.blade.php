<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="transition-colors">
    <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8">
        <img class="mx-auto mb-4 h-10 w-auto"
            src="https://cdn2.iconfinder.com/data/icons/boxicons-solid-vol-1/24/bxs-car-garage-256.png" alt="Garage">
        <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-4xl flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Hello, {{ Auth::user()->name }}
            </p>
            <form action="/logout" method="GET">
                @csrf

                <button type="submit"
                    class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors">Logout</button>
            </form>
        </div>
        <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-4xl mt-4">
            <div class="flex flex-row items-center justify-between">
                <p class="block text-lg font-semibold leading-6 text-black">
                    Seeing garage {{ $garage->name }}
                </p>
                <div class="flex flex-row items-center gap-3">
                    <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                        href="/">Back</a>
                    <a class="flex justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black transition-colors"
                        href="/new/vehicle/{{ $garage->id }}">New</a>
                </div>
            </div>
            <p class="leading-6 text-black">Cars: {{ $garage->vehicles_count }}/{{ $garage->capacity }}</p>
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
                                    <a class="flex justify-center text-sm underline font-medium leading-6 text-black group-hover:text-white transition-colors"
                                        href="/update/garage/{{ $garage->id }}/vehicle/{{ $vehicle->license_plate }}">Edit</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

</html>