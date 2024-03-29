<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use App\Models\Category;
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

        Category::factory(5)->create();


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
    }
}
