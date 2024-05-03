<nav class="w-full flex flex-col gap-1 py-2">
    <x-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link href="{{ route('roles.index') }}" :active="Str::startsWith(request()->route()->getName(), 'roles.')">
        {{ __('Roles') }}
    </x-nav-link>
    <x-nav-link href="{{ route('staff.index') }}" :active="Str::startsWith(request()->route()->getName(), 'staff.')">
        {{ __('Personal') }}
    </x-nav-link>

    <x-nav-link href="{{ route('categories.index') }}" :active="Str::startsWith(request()->route()->getName(), 'categories.')">
        {{ __('Categorias') }}
    </x-nav-link>

    <x-nav-link href="{{ route('products.index') }}" :active="Str::startsWith(request()->route()->getName(), 'products.')">
        {{ __('Productos') }}
    </x-nav-link>

    <x-nav-link href="{{ route('deliverytimes.index') }}" :active="Str::startsWith(request()->route()->getName(), 'deliverytimes.')">
        {{ __('Horarios') }}
    </x-nav-link>

    <x-nav-link href="{{ route('customers.index') }}" :active="Str::startsWith(request()->route()->getName(), 'customers.')">
        {{ __('Clientes') }}
    </x-nav-link>

    <x-nav-link href="{{ route('orders.index') }}" :active="Str::startsWith(request()->route()->getName(), 'orders.')">
        {{ __('Pedidos') }}
    </x-nav-link>

    <x-nav-link href="{{ route('sales.index') }}" :active="Str::startsWith(request()->route()->getName(), 'sales.')">
        {{ __('Ventas') }}
    </x-nav-link>

    <x-nav-link href="{{ route('payments.index') }}" :active="Str::startsWith(request()->route()->getName(), 'payments.')">
        {{ __('Pagos') }}
    </x-nav-link>
</nav>
