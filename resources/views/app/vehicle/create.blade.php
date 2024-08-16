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
                    class="flex justify-center rounded-md text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors">Logout</button>
            </form>
        </div>
        <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-4xl mt-4">
            <div class="flex flex-row items-center justify-between">
                <p class="block text-lg font-semibold leading-6 text-black">
                    Add a new vehicle to your garage
                </p>
                <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                    href="/garage/{{ $garage_id }}">Back</a>
            </div>
            <div class="mt-4">
                <div class="flex flex-col gap-3 max-h-96 overflow-y-auto -mx-3 px-3">
                    <form class="space-y-6" action="/new/vehicle/{{ $garage_id }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 px-4 py-3 rounded-md">
                                @foreach ($errors->all() as $error)
                                    <p class="block text-sm font-medium leading-6 text-red-700">
                                        {{ $error }}
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        <div>
                            <label for="license_plate" class="block text-sm font-medium leading-6 text-gray-900">License
                                plate</label>
                            <div class="mt-2">
                                <input id="license_plate" name="license_plate" type="text" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                                    placeholder="ABC1234 or ABC1D23">
                            </div>
                        </div>

                        <div>
                            <label for="brand" class="block text-sm font-medium leading-6 text-gray-900">Brand</label>
                            <div class="mt-2">
                                <input id="brand" name="brand" type="text" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="model" class="block text-sm font-medium leading-6 text-gray-900">Model</label>
                            <div class="mt-2">
                                <input id="model" name="model" type="text" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-medium leading-6 text-gray-900">Year</label>
                            <div class="mt-2">
                                <input id="year" name="year" type="number" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="color" class="block text-sm font-medium leading-6 text-gray-900">Color</label>
                            <div class="mt-2">
                                <input id="color" name="color" type="text" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black transition-colors">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>