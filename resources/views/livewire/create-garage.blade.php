<div>
    <div class="p-6 border rounded-md sm:mx-auto sm:w-full sm:max-w-4xl mt-4">
        <div class="flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Create a new garage
            </p>
            <a class="flex justify-center text-sm underline font-medium leading-6 text-black hover:text-neutral-800 transition-colors"
                href="/" wire:navigate>Back</a>
        </div>
        <div class="mt-4">
            <div class="flex flex-col gap-3 max-h-96 overflow-y-auto -mx-3 px-3">
                <form class="space-y-6" wire:submit="save">
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
                            <input id="name" name="name" type="text" autocomplete="name" wire:model="name" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                        <div class="mt-2">
                            <input id="address" name="address" type="text" autocomplete="address-level1"
                                wire:model="address" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm px-2 outline-none ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium leading-6 text-gray-900">Capacity</label>
                        <div class="mt-2">
                            <input id="capacity" name="capacity" type="number" wire:model="capacity" required
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