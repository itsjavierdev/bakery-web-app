@props(['register_bg' => 'bg-yellow-secondary', 'register' => true])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('pageTitle') - San Xavier</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Varela+Round&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/icons.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles


    @stack('links')
</head>

<body style="font-family: 'Montserrat', sans-serif;" class="bg-brown-primary text-font-primary">

    <x-message-alert />

    <x-customer.layouts.navbar />

    <main class="bg-yellow-primary min-h-[83vh]">
        <div {{ $attributes->merge(['class' => 'max-w-6xl mx-auto justify-center py-7']) }}>
            {{ $slot }}
        </div>
    </main>

    <x-customer.layouts.footer bg_color="{{ $register_bg }}" register="{{ $register }}" />

    @livewireScripts

    @stack('js')

</body>

</html>
