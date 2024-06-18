<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyContact;

class CompanyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = Address::create([
            'address' => "Séptimo anillo, Radial 26, B. 24 de septiembre, Zona Norte"
        ]);

        CompanyContact::create([
            'facebook' => 'https://www.facebook.com',
            'instagram' => 'https://www.instagram.com',
            'tiktok' => 'https://www.tiktok.com',
            'phone' => "76089443",
            'email' => "contacto@sanxavier.com",
            'address_id' => $address->id
        ]);
    }
}
