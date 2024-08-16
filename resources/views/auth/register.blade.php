<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="transition-colors">
    <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8">
        <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-sm">
            <div>
                <img class="mx-auto h-10 w-auto"
                    src="https://cdn2.iconfinder.com/data/icons/boxicons-solid-vol-1/24/bxs-car-garage-256.png"
                    alt="Garage">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register your
                    account</h2>
            </div>

            <div class="mt-10">
                <form class="space-y-6" action="/register" method="POST">
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
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                            address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black transition-colors">Register
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Already have an account?
                    <a href="/login" class="font-semibold leading-6 text-black hover:text-neutral-800">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>