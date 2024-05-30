<nav class="w-full flex flex-col gap-2 py-2">
    <x-nav-link href="{{ route('admin') }}" :active="request()->routeIs('admin')">
        <i class="icon-chart text-xl"></i>
        Dashboard
    </x-nav-link>
    <!--Admin Module-->
    @php
        $roles_active = Str::startsWith(request()->route()->getName(), 'roles.');
        $staff_active = Str::startsWith(request()->route()->getName(), 'staff.');
        $admin_active = $roles_active || $staff_active;
    @endphp
    <x-nav-select :active="$admin_active">
        <i class="icon-settings text-xl"></i>
        Administración
        <x-slot name="content">
            <x-nav-item href="{{ route('roles.index') }}" :active="$roles_active">
                Roles
            </x-nav-item>
            <x-nav-item href="{{ route('staff.index') }}" :active="$staff_active">
                Personal
            </x-nav-item>
        </x-slot>
    </x-nav-select>
    <!--Parameters Module-->
    @php
        $categories_active = Str::startsWith(request()->route()->getName(), 'categories.');
        $products_active = Str::startsWith(request()->route()->getName(), 'products.');
        $deliverytimes_active = Str::startsWith(request()->route()->getName(), 'deliverytimes.');
        $company_contact_active = Str::startsWith(request()->route()->getName(), 'company-contact.');
        $featured_active = Str::startsWith(request()->route()->getName(), 'featured.');
        $parametersActive =
            $categories_active ||
            $products_active ||
            $deliverytimes_active ||
            $company_contact_active ||
            $featured_active;
    @endphp
    <x-nav-select :active="$parametersActive">
        <i class="icon-other text-xl"></i>
        Parametros
        <x-slot name="content">
            <x-nav-item href="{{ route('categories.index') }}" :active="$categories_active">
                Categorias
            </x-nav-item>

            <x-nav-item href="{{ route('products.index') }}" :active="$products_active">
                Productos
            </x-nav-item>

            <x-nav-item href="{{ route('deliverytimes.index') }}" :active="$deliverytimes_active">
                Horarios
            </x-nav-item>

            <x-nav-item href="{{ route('company-contact.index') }}" :active="$company_contact_active">
                Información de la empresa
            </x-nav-item>

            <x-nav-item href="{{ route('featured.index') }}" :active="$featured_active">
                Imagenes destacadas
            </x-nav-item>
        </x-slot>
    </x-nav-select>
    <!--Transactions Module-->
    @php
        $order_active = Str::startsWith(request()->route()->getName(), 'orders.');
        $sales_active = Str::startsWith(request()->route()->getName(), 'sales.');
        $payments_active = Str::startsWith(request()->route()->getName(), 'payments.');
        $transactions_active = $order_active || $sales_active || $payments_active;
    @endphp
    <x-nav-select :active="$transactions_active">
        <i class="icon-money-mark text-xl"></i>
        Ventas
        <x-slot name="content">
            <x-nav-item href="{{ route('orders.index') }}" :active="$order_active">
                Pedidos
            </x-nav-item>

            <x-nav-item href="{{ route('sales.index') }}" :active="$sales_active">
                Ventas
            </x-nav-item>

            <x-nav-item href="{{ route('payments.index') }}" :active="$payments_active">
                Pagos
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
                Clientes
            </x-nav-item>
        </x-slot>
    </x-nav-select>

    <!--Customer Module-->
    @php
        $sales_report_active = Str::startsWith(request()->route()->getName(), 'reports.sales');
        $reports_active = Str::startsWith(request()->route()->getName(), 'reports.');
    @endphp
    <x-nav-select :active="$reports_active">
        <i class="icon-clipboard text-xl"></i>
        Reportes
        <x-slot name="content">

            <x-nav-item href="{{ route('reports.sales.index') }}" :active="$sales_report_active">
                Reporte de ventas
            </x-nav-item>

        </x-slot>
    </x-nav-select>
</nav>
