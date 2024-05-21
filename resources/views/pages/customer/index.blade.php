<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>San Xavier</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat&family=Varela+Round&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/icons.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body style="font-family: 'Montserrat', sans-serif;" class="bg-yellow-primary text-font-primary">

    <x-message-alert />

    @if ($featured)
        <x-customer.layouts.featured />
    @else
        <x-customer.layouts.navbar />
    @endif

    <main>
        <livewire:customer.products.recommended />
    </main>

    <x-customer.layouts.footer />

    @livewireScripts

    @stack('js')



</body>

</html>
