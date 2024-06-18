<nav class="w-full flex flex-col gap-2 py-2">
    @can('sales_report.generate')
        <x-nav-link href="{{ route('admin') }}" :active="request()->routeIs('admin')">
            <i class="icon-chart text-xl"></i>
            Dashboard
        </x-nav-link>
    @endcan
    <!--Admin Module-->
    @php
        $roles_active = Str::startsWith(request()->route()->getName(), 'roles.');
        $staff_active = Str::startsWith(request()->route()->getName(), 'staff.');
        $admin_active = $roles_active || $staff_active;
    @endphp
    @canany(['roles.read', 'staff.read'])
        <x-nav-select :active="$admin_active">
            <i class="icon-settings text-xl"></i>
            Administración
            <x-slot name="content">
                @can('roles.read')
                    <x-nav-item href="{{ route('roles.index') }}" :active="$roles_active">
                        Roles
                    </x-nav-item>
                @endcan
                @can('staff.read')
                    <x-nav-item href="{{ route('staff.index') }}" :active="$staff_active">
                        Personal
                    </x-nav-item>
                @endcan
            </x-slot>
        </x-nav-select>
    @endcanany
    <!--Parameters Module-->
    @php
        $categories_active = Str::startsWith(request()->route()->getName(), 'categories.');
        $products_active = Str::startsWith(request()->route()->getName(), 'products.');
        $deliverytimes_active = Str::startsWith(request()->route()->getName(), 'deliverytimes.');
        $company_contact_active = Str::startsWith(request()->route()->getName(), 'companycontact.');
        $featured_active = Str::startsWith(request()->route()->getName(), 'featured.');
        $parametersActive =
            $categories_active ||
            $products_active ||
            $deliverytimes_active ||
            $company_contact_active ||
            $featured_active;
    @endphp
    @canany(['categories.read', 'products.read', 'deliverytimes.read', 'companycontact.read', 'featured.read'])
        <x-nav-select :active="$parametersActive">
            <i class="icon-other text-xl"></i>
            Parametros
            <x-slot name="content">
                @can('categories.read')
                    <x-nav-item href="{{ route('categories.index') }}" :active="$categories_active">
                        Categorias
                    </x-nav-item>
                @endcan
                @can('products.read')
                    <x-nav-item href="{{ route('products.index') }}" :active="$products_active">
                        Productos
                    </x-nav-item>
                @endcan
                @can('deliverytimes.read')
                    <x-nav-item href="{{ route('deliverytimes.index') }}" :active="$deliverytimes_active">
                        Horarios
                    </x-nav-item>
                @endcan
                @can('companycontact.read')
                    <x-nav-item href="{{ route('companycontact.index') }}" :active="$company_contact_active">
                        Información de la empresa
                    </x-nav-item>
                @endcan
                {{-- @can('featured.read')
                    <x-nav-item href="{{ route('featured.index') }}" :active="$featured_active">
                        Imagenes destacadas
                    </x-nav-item>
                @endcan --}}
            </x-slot>
        </x-nav-select>
    @endcanany
    <!--Transactions Module-->
    @php
        $order_active = Str::startsWith(request()->route()->getName(), 'orders.');
        $sales_active = Str::startsWith(request()->route()->getName(), 'sales.');
        $debts_active = Str::startsWith(request()->route()->getName(), 'debts.');
        $payments_active = Str::startsWith(request()->route()->getName(), 'payments.');
        $transactions_active = $order_active || $sales_active || $payments_active || $debts_active;
    @endphp
    @canany(['orders.read', 'sales.read', 'debts.read', 'payments.read'])
        <x-nav-select :active="$transactions_active">
            <i class="icon-money-mark text-xl"></i>
            Ventas
            <x-slot name="content">
                @can('orders.read')
                    <x-nav-item href="{{ route('orders.index') }}" :active="$order_active">
                        Pedidos
                    </x-nav-item>
                @endcan
                @can('sales.read')
                    <x-nav-item href="{{ route('sales.index') }}" :active="$sales_active">
                        Ventas
                    </x-nav-item>
                @endcan
                @can('debts.read')
                    <x-nav-item href="{{ route('debts.all') }}" :active="$debts_active">
                        Deudas
                    </x-nav-item>
                @endcan
                @can('payments.read')
                    <x-nav-item href="{{ route('payments.index') }}" :active="$payments_active">
                        Pagos
                    </x-nav-item>
                @endcan
            </x-slot>
        </x-nav-select>
    @endcanany
    <!--Customer Module-->
    @php
        $customersActive = Str::startsWith(request()->route()->getName(), 'customers.');
    @endphp
    @canany(['customers.read'])
        <x-nav-select :active="$customersActive">
            <i class="icon-user text-xl"></i>
            Clientes
            <x-slot name="content">
                @can('customers.read')
                    <x-nav-item href="{{ route('customers.index') }}" :active="Str::startsWith(request()->route()->getName(), 'customers.')">
                        Clientes
                    </x-nav-item>
                @endcan
            </x-slot>
        </x-nav-select>
    @endcanany
    <!--Customer Module-->
    @php
        $sales_report_active = Str::startsWith(request()->route()->getName(), 'reports.sales');
        $orders_report_active = Str::startsWith(request()->route()->getName(), 'reports.orders');
        $vouchers_generate = Str::startsWith(request()->route()->getName(), 'vouchers');
        $reports_active = Str::startsWith(request()->route()->getName(), 'reports.') || $vouchers_generate;
    @endphp
    @canany(['sales_report.generate', 'orders_report.generate'])
        <x-nav-select :active="$reports_active">
            <i class="icon-clipboard text-xl"></i>
            Reportes
            <x-slot name="content">
                @can('sales_report.generate')
                    <x-nav-item href="{{ route('reports.sales.index') }}" :active="$sales_report_active">
                        Reporte de ventas
                    </x-nav-item>
                @endcan
                @can('orders_report.generate')
                    <x-nav-item href="{{ route('reports.orders.index') }}" :active="$orders_report_active">
                        Reporte de pedidos
                    </x-nav-item>
                @endcan
                @can('vouchers.generate')
                    <x-nav-item href="{{ route('vouchers.index') }}" :active="$vouchers_generate">
                        Comprobantes
                    </x-nav-item>
                @endcan
            </x-slot>
        </x-nav-select>
    @endcanany

</nav>
