<aside id="sidebar"
    class="min-h-screen overflow-y-auto z-30 md:z-0 bg-yellow-50  md:relative top-0 left-0 fixed flex flex-col justify-between md:w-48 w-0 md:mx-1">
    <div>
        <header class="w-full h-auto px-2 py-2 flex flex-col">
            <button id="closeSidebarMobile" class="flex justify-end absolute md:hidden right-5 top-5">
                <i class="icon-x text-xl text-gray-800"></i>
            </button>
            <!-- Logo-->
            <div class="flex justify-center">
                <a href="{{ route('/') }}" class="focus:bg-yellow-100 rounded-full  focus:outline-none">
                    <x-logo class="rounded-full p-2" width=80 />
                </a>
            </div>
        </header>

        {{ $slot }}
    </div>
    <!-- Settings Dropdown -->
    <div>
        <hr>
        <div>
            <x-settings-dropdown isMobile="{{ false }}">
                <x-slot name="trigger">
                    <x-nav-link :active="request()->routeIs('profile.show')" class="w-full flex justify-between items-center">
                        <div class="flex gap-1 items-center w-full">
                            <i
                                class="icon-{{ request()->routeIs('profile.show') ? 'user-fill' : 'user' }} text-lg hidden md:block">
                            </i>
                            {{ explode(' ', Auth::user()->staff->name)[0] }}
                        </div>
                        <i class="icon-chevron-down text-sm hidden md:block"></i>
                    </x-nav-link>
                </x-slot>
            </x-settings-dropdown>
        </div>
    </div>
</aside>
