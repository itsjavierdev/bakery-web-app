<nav class="w-full flex flex-col gap-2 py-2">
    <x-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
        <i class="icon-chart text-xl"></i>
        {{ __('Dashboard') }}
    </x-nav-link>
    <!--Admin Module-->
    @php
        $adminActive =
            Str::startsWith(request()->route()->getName(), 'roles.') ||
            Str::startsWith(request()->route()->getName(), 'staff.');
    @endphp
    <x-nav-select :active="$adminActive">
        <i class="icon-settings text-xl"></i>
        Administración
        <x-slot name="content">
            <x-nav-item href="{{ route('roles.index') }}" :active="Str::startsWith(request()->route()->getName(), 'roles.')">
                {{ __('Roles') }}
            </x-nav-item>
            <x-nav-item href="{{ route('staff.index') }}" :active="Str::startsWith(request()->route()->getName(), 'staff.')">
                {{ __('Personal') }}
            </x-nav-item>
        </x-slot>
    </x-nav-select>
    <!--Parameters Module-->
    @php
        $parametersActive =
            Str::startsWith(request()->route()->getName(), 'categories.') ||
            Str::startsWith(request()->route()->getName(), 'products.') ||
            Str::startsWith(request()->route()->getName(), 'deliverytimes.');
    @endphp
    <x-nav-select :active="$parametersActive">
        <i class="icon-clipboard text-xl"></i>
        Parametros
        <x-slot name="content">
            <x-nav-item href="{{ route('categories.index') }}" :active="Str::startsWith(request()->route()->getName(), 'categories.')">
                {{ __('Categorias') }}
            </x-nav-item>

            <x-nav-item href="{{ route('products.index') }}" :active="Str::startsWith(request()->route()->getName(), 'products.')">
                {{ __('Productos') }}
            </x-nav-item>

            <x-nav-item href="{{ route('deliverytimes.index') }}" :active="Str::startsWith(request()->route()->getName(), 'deliverytimes.')">
                {{ __('Horarios') }}
            </x-nav-item>
        </x-slot>
    </x-nav-select>
    <!--Transactions Module-->
    @php
        $salesActive =
            Str::startsWith(request()->route()->getName(), 'orders.') ||
            Str::startsWith(request()->route()->getName(), 'sales.') ||
            Str::startsWith(request()->route()->getName(), 'payments.');
    @endphp
    <x-nav-select :active="$salesActive">
        <i class="icon-cart text-xl"></i>
        Ventas
        <x-slot name="content">
            <x-nav-item href="{{ route('orders.index') }}" :active="Str::startsWith(request()->route()->getName(), 'orders.')">
                {{ __('Pedidos') }}
            </x-nav-item>

            <x-nav-item href="{{ route('sales.index') }}" :active="Str::startsWith(request()->route()->getName(), 'sales.')">
                {{ __('Ventas') }}
            </x-nav-item>

            <x-nav-item href="{{ route('payments.index') }}" :active="Str::startsWith(request()->route()->getName(), 'payments.')">
                {{ __('Pagos') }}
            </x-nav-item>
        </x-slot>
    </x-nav-select>
    <!--Customer Module-->
    @php
        $customersActive = Str::startsWith(request()->route()->getName(), 'customers.');
    @endphp
    <x-nav-select :active="$customersActive">
        <i class="icon-user text-xl"></i>
        Clientes
        <x-slot name="content">

            <x-nav-item href="{{ route('customers.index') }}" :active="Str::startsWith(request()->route()->getName(), 'customers.')">
                {{ __('Clientes') }}
            </x-nav-item>
        </x-slot>
    </x-nav-select>

</nav>
