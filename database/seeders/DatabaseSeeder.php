<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'email' => 'admin@sanxavier.com',
        ])->assignRole('Administrador');

        $users = User::factory(10)->create();

        $roles = ['Encargado de ventas', 'Repartidor', 'Encargado de pedidos', 'Encargado de contenidos'];

        foreach ($users as $user) {
            $user->assignRole($roles[array_rand($roles)]);
        }

        $this->call(CompanyContactSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(DeliveryTimeSeeder::class);
        Customer::factory(10)->create();
        Sale::factory(600)->create();
        Order::factory(140)->create();

    }
}
