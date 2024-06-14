<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\CompanyContact;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\User;
use App\Models\Staff;
use App\Models\Category;
use App\Models\DeliveryTime;
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
            'email' => 'test@example.com',
        ])->assignRole('Administrador');

        $users = User::factory(10)->create();

        $roles = ['Encargado de ventas', 'Repartidor', 'Encargado de pedidos', 'Encargado de contenidos'];

        foreach ($users as $user) {
            $user->assignRole($roles[array_rand($roles)]);
        }

        $this->call(CategorySeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(DeliveryTimeSeeder::class);

        Customer::factory(10)->create();
    }
}
