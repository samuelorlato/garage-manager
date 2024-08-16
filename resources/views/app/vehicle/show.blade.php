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
                    Seeing vehicle {{ $vehicle->license_plate }}
                </p>
                <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                    href="/garage/{{ $vehicle->garage_id }}">Back</a>
            </div>
            <div class="mt-4">
                <div class="flex flex-col justify-between items-start">
                    <div>In garage since:
                        {{ \Carbon\Carbon::parse($vehicle->in_garage_since)->format('d/m/y') }}
                    </div>
                    <div>Model: {{ $vehicle->model }}</div>
                    <div>Brand: {{ $vehicle->brand }}</div>
                    <div>Year: {{ $vehicle->year }}</div>
                    <div>Color: {{ $vehicle->color }}</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>