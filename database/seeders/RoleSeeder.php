<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'Administrador']);
        $role_sales = Role::create(['name' => 'Encargado de ventas']);
        $role_delivery = Role::create(['name' => 'Repartidor']);
        $role_orders = Role::create(['name' => 'Encargado de pedidos']);
        $role_parameters = Role::create(['name' => 'Encargado de contenidos']);

        Permission::create(['name' => 'dashboard', 'description' => 'Ver', 'module' => 'Panel', 'action' => 'read'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'roles.create', 'description' => 'Crear', 'module' => 'Roles', 'action' => 'create'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.read', 'description' => 'Ver', 'module' => 'Roles', 'action' => 'read'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.update', 'description' => 'Editar', 'module' => 'Roles', 'action' => 'update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'roles.delete', 'description' => 'Eliminar', 'module' => 'Roles', 'action' => 'delete'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'staff.create', 'description' => 'Crear', 'module' => 'Personal', 'action' => 'create'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'staff.read', 'description' => 'Ver', 'module' => 'Personal', 'action' => 'read'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'staff.update', 'description' => 'Editar', 'module' => 'Personal', 'action' => 'update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'staff.delete', 'description' => 'Eliminar', 'module' => 'Personal', 'action' => 'delete'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'user.create', 'description' => 'Crear', 'module' => 'Usuario', 'action' => 'create'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'user.update', 'description' => 'Editar', 'module' => 'Usuario', 'action' => 'update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'user.delete', 'description' => 'Eliminar', 'module' => 'Usuario', 'action' => 'delete'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'profile.update', 'description' => 'Editar', 'module' => 'Perfil', 'action' => 'update'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'categories.create', 'description' => 'Crear', 'module' => 'Categorías', 'action' => 'create'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'categories.read', 'description' => 'Ver', 'module' => 'Categorías', 'action' => 'read'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'categories.update', 'description' => 'Editar', 'module' => 'Categorías', 'action' => 'update'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'categories.delete', 'description' => 'Eliminar', 'module' => 'Categorías', 'action' => 'delete'])->syncRoles([$role_admin, $role_parameters]);

        Permission::create(['name' => 'products.create', 'description' => 'Crear', 'module' => 'Productos', 'action' => 'create'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'products.read', 'description' => 'Ver', 'module' => 'Productos', 'action' => 'read'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'products.update', 'description' => 'Editar', 'module' => 'Productos', 'action' => 'update'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'products.delete', 'description' => 'Eliminar', 'module' => 'Productos', 'action' => 'delete'])->syncRoles([$role_admin, $role_parameters]);

        Permission::create(['name' => 'featured.create', 'description' => 'Crear', 'module' => 'Detacados', 'action' => 'create'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'featured.read', 'description' => 'Ver', 'module' => 'Detacados', 'action' => 'read'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'featured.update', 'description' => 'Editar', 'module' => 'Detacados', 'action' => 'update'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'featured.delete', 'description' => 'Eliminar', 'module' => 'Detacados', 'action' => 'delete'])->syncRoles([$role_admin, $role_parameters]);

        Permission::create(['name' => 'deliverytimes.create', 'description' => 'Crear', 'module' => 'Horas de entrega', 'action' => 'create'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'deliverytimes.read', 'description' => 'Ver', 'module' => 'Horas de entrega', 'action' => 'read'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'deliverytimes.update', 'description' => 'Editar', 'module' => 'Horas de entrega', 'action' => 'update'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'deliverytimes.delete', 'description' => 'Eliminar', 'module' => 'Horas de entrega', 'action' => 'delete'])->syncRoles([$role_admin, $role_parameters]);

        Permission::create(['name' => 'companycontact.read', 'description' => 'Ver', 'module' => 'Información de contacto', 'action' => 'read'])->syncRoles([$role_admin, $role_parameters]);
        Permission::create(['name' => 'companycontact.update', 'description' => 'Editar', 'module' => 'Información de contacto', 'action' => 'update'])->syncRoles([$role_admin, $role_parameters]);

        Permission::create(['name' => 'orders.create', 'description' => 'Crear', 'module' => 'Pedidos', 'action' => 'create'])->syncRoles([$role_admin, $role_orders]);
        Permission::create(['name' => 'orders.read', 'description' => 'Ver', 'module' => 'Pedidos', 'action' => 'read'])->syncRoles([$role_admin, $role_orders]);
        Permission::create(['name' => 'orders.update', 'description' => 'Editar', 'module' => 'Pedidos', 'action' => 'update'])->syncRoles([$role_admin, $role_orders]);
        Permission::create(['name' => 'orders.delete', 'description' => 'Eliminar', 'module' => 'Pedidos', 'action' => 'delete'])->syncRoles([$role_admin, $role_orders]);
        Permission::create(['name' => 'orders.delivery', 'description' => 'Enviar', 'module' => 'Pedidos', 'action' => 'delivery'])->syncRoles([$role_admin, $role_orders]);

        Permission::create(['name' => 'sales.create', 'description' => 'Crear', 'module' => 'Ventas', 'action' => 'create'])->syncRoles([$role_admin, $role_sales]);
        Permission::create(['name' => 'sales.read', 'description' => 'Ver', 'module' => 'Ventas', 'action' => 'read'])->syncRoles([$role_admin, $role_sales]);
        Permission::create(['name' => 'sales.update', 'description' => 'Editar', 'module' => 'Ventas', 'action' => 'update'])->syncRoles([$role_admin, $role_sales]);
        Permission::create(['name' => 'sales.delete', 'description' => 'Eliminar', 'module' => 'Ventas', 'action' => 'delete'])->syncRoles([$role_admin, $role_sales]);

        Permission::create(['name' => 'debts.add', 'description' => 'Agregar', 'module' => 'Pagos', 'action' => 'add'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'debts.read', 'description' => 'Ver', 'module' => 'Deudas', 'action' => 'read'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'debts.update', 'description' => 'Editar', 'module' => 'Deudas', 'action' => 'update'])->syncRoles([$role_admin]);


        Permission::create(['name' => 'payments.read', 'description' => 'Ver', 'module' => 'Pagos', 'action' => 'read'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'payments.update', 'description' => 'Editar', 'module' => 'Pagos', 'action' => 'update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'payments.delete', 'description' => 'Eliminar', 'module' => 'Pagos', 'action' => 'delete'])->syncRoles([$role_admin]);


        Permission::create(['name' => 'customers.create', 'description' => 'Crear', 'module' => 'Clientes', 'action' => 'create'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'customers.read', 'description' => 'Ver', 'module' => 'Clientes', 'action' => 'read'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'customers.update', 'description' => 'Editar', 'module' => 'Clientes', 'action' => 'update'])->syncRoles([$role_admin]);
        Permission::create(['name' => 'customers.delete', 'description' => 'Eliminar', 'module' => 'Clientes', 'action' => 'delete'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'sales_report.generate', 'description' => 'Generar', 'module' => 'Reporte de ventas', 'action' => 'generate'])->syncRoles([$role_admin, $role_sales]);

        Permission::create(['name' => 'orders_report.generate', 'description' => 'Generar', 'module' => 'Reporte de pedidos', 'action' => 'generate'])->syncRoles([$role_admin, $role_orders]);

        Permission::create(['name' => 'vouchers.generate', 'description' => 'Generar', 'module' => 'Comprobante', 'action' => 'generate'])->syncRoles([$role_admin]);
    }
}
