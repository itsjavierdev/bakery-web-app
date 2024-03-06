<!-- Topbar for mobile -->
<nav class="md:hidden w-full h-auto flex items-center justify-between bg-white p-3 shadow sticky top-0 z-20">
    <!-- Sidebar button-->
    <button class="flex items center ms-2">
        <i class="icon-bars text-2xl text-gray-800"></i>
    </button>

    <x-settings-dropdown isMobile=true>
        <x-slot name="trigger">
            <span class="inline-flex rounded-md">
                <button type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                    {{ explode(' ', Auth::user()->staff->name)[0] }}
                    <i class="icon-chevron-down text-sm text-gray-500 ms-2 -me-0.5"></i>
                </button>
            </span>
        </x-slot>
    </x-settings-dropdown>
</nav>
<!-- Sidebar button in large screens -->
<div class="hidden md:block md:absolute top-6 left-3 z-10">
    <button class="flex items center ms-2">

        <i class="icon-x text-xl text-gray-800 "></i>
    </button>
</div>
