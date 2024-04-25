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

    <x-nav-link href="{{ route('categorias.index') }}" :active="Str::startsWith(request()->route()->getName(), 'categorias.')">
        {{ __('Categorias') }}
    </x-nav-link>

    <x-nav-link href="{{ route('productos.index') }}" :active="Str::startsWith(request()->route()->getName(), 'productos.')">
        {{ __('Productos') }}
    </x-nav-link>

    <x-nav-link href="{{ route('horarios.index') }}" :active="Str::startsWith(request()->route()->getName(), 'horarios.')">
        {{ __('Horarios') }}
    </x-nav-link>

    <x-nav-link href="{{ route('clientes.index') }}" :active="Str::startsWith(request()->route()->getName(), 'clientes.')">
        {{ __('Clientes') }}
    </x-nav-link>

    <x-nav-link href="{{ route('pedidos.index') }}" :active="Str::startsWith(request()->route()->getName(), 'pedidos.')">
        {{ __('Pedidos') }}
    </x-nav-link>

    <x-nav-link href="{{ route('ventas.index') }}" :active="Str::startsWith(request()->route()->getName(), 'ventas.')">
        {{ __('Ventas') }}
    </x-nav-link>
</nav>
