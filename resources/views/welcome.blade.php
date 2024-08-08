<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-black/50">
    <div class="flex flex-col min-h-screen px-5 m-auto max-w-7xl">

        <div class="flex justify-end p-4">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        </div>

        <div class="flex flex-col items-center justify-center flex-grow p-6 mx-auto space-y-10 max-w-7xl lg:p-8">
            <x-application-logo class="w-24 h-24 fill-current text-primary-500" />
            <x-button primary xl href="{{ route('register') }}">Get Started</x-button>
        </div>

    </div>
</body>

</html>
