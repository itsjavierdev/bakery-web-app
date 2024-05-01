<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\OrderDetail;
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
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);

        Product::factory(10)->create();

        Staff::factory(5)->create();

        User::factory()->create([
            'email' => 'test@example.com',
        ])->assignRole('Administrador');

        User::factory()->create([
            'email' => 'javier@gmail.com',
        ])->assignRole('Administrador');

        $users = User::factory(20)->create();

        foreach ($users as $user) {
            $user->assignRole('Administrador');
        }

        OrderDetail::factory(10)->create();

        SaleDetail::factory(1)->create();
    }
}
