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

        Permission::create(['name' => 'dashboard', 'description' => 'Ver', 'module' => 'Panel', 'action' => 'read'])->syncRoles([$role_admin]);

        Permission::create(['name' => 'roles.create', 'description' => 'Crear', 'module' => 'Roles', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'roles.read', 'description' => 'Ver', 'module' => 'Roles', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'roles.update', 'description' => 'Editar', 'module' => 'Roles', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'roles.delete', 'description' => 'Eliminar', 'module' => 'Roles', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'staff.create', 'description' => 'Crear', 'module' => 'Personal', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'staff.read', 'description' => 'Ver', 'module' => 'Personal', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'staff.update', 'description' => 'Editar', 'module' => 'Personal', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'staff.delete', 'description' => 'Eliminar', 'module' => 'Personal', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'user.create', 'description' => 'Crear', 'module' => 'Usuario', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'user.update', 'description' => 'Editar', 'module' => 'Usuario', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'user.delete', 'description' => 'Eliminar', 'module' => 'Usuario', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'profile.update', 'description' => 'Editar', 'module' => 'Perfil', 'action' => 'update'])->assignRole($role_admin);

        Permission::create(['name' => 'categories.create', 'description' => 'Crear', 'module' => 'Categorías', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'categories.read', 'description' => 'Ver', 'module' => 'Categorías', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'categories.update', 'description' => 'Editar', 'module' => 'Categorías', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'categories.delete', 'description' => 'Eliminar', 'module' => 'Categorías', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'products.create', 'description' => 'Crear', 'module' => 'Productos', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'products.read', 'description' => 'Ver', 'module' => 'Productos', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'products.update', 'description' => 'Editar', 'module' => 'Productos', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'products.delete', 'description' => 'Eliminar', 'module' => 'Productos', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'featured.create', 'description' => 'Crear', 'module' => 'Detacados', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'featured.read', 'description' => 'Ver', 'module' => 'Detacados', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'featured.update', 'description' => 'Editar', 'module' => 'Detacados', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'featured.delete', 'description' => 'Eliminar', 'module' => 'Detacados', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'deliverytimes.create', 'description' => 'Crear', 'module' => 'Horas de entrega', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'deliverytimes.read', 'description' => 'Ver', 'module' => 'Horas de entrega', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'deliverytimes.update', 'description' => 'Editar', 'module' => 'Horas de entrega', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'deliverytimes.delete', 'description' => 'Eliminar', 'module' => 'Horas de entrega', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'companycontact.read', 'description' => 'Ver', 'module' => 'Información de contacto', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'companycontact.update', 'description' => 'Editar', 'module' => 'Información de contacto', 'action' => 'update'])->assignRole($role_admin);

        Permission::create(['name' => 'orders.create', 'description' => 'Crear', 'module' => 'Pedidos', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'orders.read', 'description' => 'Ver', 'module' => 'Pedidos', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'orders.update', 'description' => 'Editar', 'module' => 'Pedidos', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'orders.delete', 'description' => 'Eliminar', 'module' => 'Pedidos', 'action' => 'delete'])->assignRole($role_admin);
        Permission::create(['name' => 'orders.delivery', 'description' => 'Enviar', 'module' => 'Pedidos', 'action' => 'delivery'])->assignRole($role_admin);

        Permission::create(['name' => 'sales.create', 'description' => 'Crear', 'module' => 'Ventas', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'sales.read', 'description' => 'Ver', 'module' => 'Ventas', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'sales.update', 'description' => 'Editar', 'module' => 'Ventas', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'sales.delete', 'description' => 'Eliminar', 'module' => 'Ventas', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'debts.add', 'description' => 'Agregar', 'module' => 'Pagos', 'action' => 'add'])->assignRole($role_admin);
        Permission::create(['name' => 'debts.read', 'description' => 'Ver', 'module' => 'Deudas', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'debts.update', 'description' => 'Editar', 'module' => 'Deudas', 'action' => 'update'])->assignRole($role_admin);


        Permission::create(['name' => 'payments.read', 'description' => 'Ver', 'module' => 'Pagos', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'payments.update', 'description' => 'Editar', 'module' => 'Pagos', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'payments.delete', 'description' => 'Eliminar', 'module' => 'Pagos', 'action' => 'delete'])->assignRole($role_admin);


        Permission::create(['name' => 'customers.create', 'description' => 'Crear', 'module' => 'Clientes', 'action' => 'create'])->assignRole($role_admin);
        Permission::create(['name' => 'customers.read', 'description' => 'Ver', 'module' => 'Clientes', 'action' => 'read'])->assignRole($role_admin);
        Permission::create(['name' => 'customers.update', 'description' => 'Editar', 'module' => 'Clientes', 'action' => 'update'])->assignRole($role_admin);
        Permission::create(['name' => 'customers.delete', 'description' => 'Eliminar', 'module' => 'Clientes', 'action' => 'delete'])->assignRole($role_admin);

        Permission::create(['name' => 'sales_report.trigger', 'description' => 'Generar', 'module' => 'Reporte de ventas', 'action' => 'trigger'])->assignRole($role_admin);

        Permission::create(['name' => 'orders_report.trigger', 'description' => 'Generar', 'module' => 'Reporte de pedidos', 'action' => 'trigger'])->assignRole($role_admin);

        Permission::create(['name' => 'proof.trigger', 'description' => 'Generar', 'module' => 'Comprobante', 'action' => 'trigger'])->assignRole($role_admin);
    }
}
