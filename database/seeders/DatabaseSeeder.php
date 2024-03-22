<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
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

        Staff::factory(20)->create();

        User::factory()->create([
            'email' => 'test@example.com',
        ])->assignRole('Administrador');

        User::factory()->create([
            'email' => 'javier@gmail.com',
        ])->assignRole('Administrador');
    }
}
