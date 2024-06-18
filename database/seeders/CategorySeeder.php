<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = new Category;
        $category1->name = "Panes";
        $category1->save();


        $category5 = new Category;
        $category5->name = "Tortillas";
        $category5->save();

        $category3 = new Category;
        $category3->name = "Horneados típicos";
        $category3->save();

        $category4 = new Category;
        $category4->name = "Especiales";
        $category4->save();

        // $category5 = new Category;
        // $category5->name = "Tortas";
        // $category5->save();

        // $category6 = new Category;
        // $category6->name = "Salteñas";
        // $category6->save();

        $category7 = new Category;
        $category7->name = "Otros";
        $category7->save();


        $category2 = new Category;
        $category2->name = "Empanadas";
        $category2->save();
    }
}
