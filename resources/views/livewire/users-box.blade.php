<div class="sm:col-span-2">
    <div class="p-6 border rounded-md">
        <div class="flex flex-row items-center justify-between">
            <p class="block text-lg font-semibold leading-6 text-black">
                Users <span class="font-normal">({{ count($users) }})</span>
            </p>
        </div>
        <div class="mt-4 overflow-x-auto max-h-96 -m-3">
            @if (count($users) === 0)
                <p>New users will appear here...</p>
            @else
                <table class="w-full border-separate border-spacing-4">
                    <thead>
                        <tr>
                            <th class="border rounded-md p-3">Email</th>
                            <th class="border rounded-md p-3">Name</th>
                            <th class="border rounded-md p-3">Vehicles</th>
                            <th class="border rounded-md p-3">Garages</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border rounded-md p-3">{{ $user->email }}</td>
                                <td class="border rounded-md p-3">{{ $user->name  }}</td>
                                <td class="border rounded-md p-3">{{ $user->vehicles_count }}</td>
                                <td class="border rounded-md p-3">{{ $user->garages_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>