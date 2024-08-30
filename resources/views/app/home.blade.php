<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="transition-colors">
    <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8 sm:mx-auto sm:w-full sm:max-w-6xl">
        <livewire:header />
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            @if (Auth::user()->is_admin)
                <livewire:users-box />
            @endif
            <livewire:garages-box />
            <livewire:vehicles-box />
        </div>
    </div>
    </div>
</body>

</html>