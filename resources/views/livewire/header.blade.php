<div>
    <img class="mx-auto mb-4 h-10 w-auto"
        src="https://cdn2.iconfinder.com/data/icons/boxicons-solid-vol-1/24/bxs-car-garage-256.png" alt="Garage">
    <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-6xl flex flex-row items-center justify-between">
        <p class="block text-lg font-semibold leading-6 text-black">
            Hello, {{ Auth::user()->name }}
        </p>
        <form action="/logout" method="GET">
            @csrf

            <button type="submit"
                class="flex justify-center rounded-md text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors">Logout</button>
        </form>
    </div>
</div>