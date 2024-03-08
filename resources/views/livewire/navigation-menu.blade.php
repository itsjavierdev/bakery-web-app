<nav class="w-full flex flex-col gap-1 py-2">
    <x-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
        <i class="icon-{{ request()->routeIs('/') ? 'user-fill' : 'user' }} text-lg hidden md:block"></i>
        {{ __('Dashboard') }}
    </x-nav-link>
</nav>
