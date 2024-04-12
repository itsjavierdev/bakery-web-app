<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('pagetitle')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/sidebar.js', 'resources/css/icons.css'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-message-alert />

    <div class="flex bg-white md:bg-yellow-50 " id="wrapper">

        <x-sidebar>
            @livewire('livewire.admin.navigation-menu')
        </x-sidebar>

        <div id="body" class="w-full h-screen overflow-y-scroll scroll-smooth scrollbar-index">
            <div class="md:shadow-md md:bg-white md:rounded-lg md:my-2 md:me-2 relative min-h-[100%] md:min-h-[98%]  flex flex-col overflow-x-hidden"
                id="content">

                <x-topbar />

                <!-- Page Content -->
                <main class="flex-grow flex flex-col">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>


    @stack('modals')

    @livewireScripts

    @stack('js')
</body>

</html>
