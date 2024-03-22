<nav class="w-full flex flex-col gap-1 py-2">
    <x-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link href="{{ route('roles.index') }}" :active="Str::startsWith(request()->route()->getName(), 'roles.')">
        {{ __('Roles') }}
    </x-nav-link>
    <x-nav-link href="{{ route('personal.index') }}" :active="Str::startsWith(request()->route()->getName(), 'personal.')">
        {{ __('Personal') }}
    </x-nav-link>
</nav>
