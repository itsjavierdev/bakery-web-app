<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = new Product;
        $product1->name = "Churro";
        $product1->price = 3;
        $product1->bag_quantity = 6;
        $product1->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product1->category_id = 4;
        $product1->save();

        $product2 = new Product;
        $product2->name = "Cuernito";
        $product2->price = 3;
        $product2->bag_quantity = 6;
        $product2->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product2->category_id = 4;
        $product2->save();

        $product3 = new Product;
        $product3->name = "Cuñapé";
        $product3->price = 2;
        $product3->bag_quantity = 5;
        $product3->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product3->category_id = 3;
        $product3->save();

        $product4 = new Product;
        $product4->name = "Empanada con queso";
        $product4->price = 2;
        $product4->bag_quantity = 10;
        $product4->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product4->category_id = 2;
        $product4->save();

        $product5 = new Product;
        $product5->name = "Empanada de Arroz";
        $product5->price = 4;
        $product5->bag_quantity = 12;
        $product5->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product5->category_id = 3;
        $product5->save();

        $product6 = new Product;
        $product6->name = "Empanada pizza";
        $product6->price = 3;
        $product6->bag_quantity = 10;
        $product6->description = 'Rellenas de queso, jamón, salsa de tomate y choclo';
        $product6->category_id = 2;
        $product6->save();

        $product7 = new Product;
        $product7->name = "Jochabau";
        $product7->price = 2;
        $product7->bag_quantity = 5;
        $product7->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product7->category_id = 1;
        $product7->save();

        $product8 = new Product;
        $product8->name = "Marraqueta";
        $product8->price = 1;
        $product8->bag_quantity = 20;
        $product8->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product8->category_id = 1;
        $product8->save();

        $product9 = new Product;
        $product9->name = "Medialuna";
        $product9->price = 1;
        $product9->bag_quantity = 15;
        $product9->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product9->category_id = 4;
        $product9->save();

        $product10 = new Product;
        $product10->name = "Pan casero con queso";
        $product10->price = 1;
        $product10->bag_quantity = 5;
        $product10->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product10->category_id = 1;
        $product10->save();

        $product11 = new Product;
        $product11->name = "Pan casero con harina";
        $product11->price = 1;
        $product11->bag_quantity = 3;
        $product11->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product11->category_id = 1;
        $product11->save();

        $product12 = new Product;
        $product12->name = "Pan con queso";
        $product12->price = 1;
        $product12->bag_quantity = 6;
        $product12->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product12->category_id = 1;
        $product12->save();

        $product13 = new Product;
        $product13->name = "Pan con harina";
        $product13->price = 1;
        $product13->bag_quantity = 6;
        $product13->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product13->category_id = 1;
        $product13->save();

        $product14 = new Product;
        $product14->name = "Pan de arroz";
        $product14->price = 1;
        $product14->bag_quantity = 6;
        $product14->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product14->category_id = 3;
        $product14->save();

        $product15 = new Product;
        $product15->name = "Pan de panchito";
        $product15->price = 1;
        $product15->bag_quantity = 6;
        $product15->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product15->category_id = 1;
        $product15->save();

        $product16 = new Product;
        $product16->name = "Pan nudo";
        $product16->price = 1;
        $product16->bag_quantity = 6;
        $product16->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product16->category_id = 1;
        $product16->save();

        $product17 = new Product;
        $product17->name = "Rollito";
        $product17->price = 2;
        $product17->bag_quantity = 6;
        $product17->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product17->category_id = 3;
        $product17->save();

        $product18 = new Product;
        $product18->name = "Rosquita de cuñapé";
        $product18->price = 1;
        $product18->bag_quantity = 6;
        $product18->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product18->category_id = 3;
        $product18->save();

        $product19 = new Product;
        $product19->name = "rosquitademaiz";
        $product19->price = 3;
        $product19->bag_quantity = 6;
        $product19->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product19->category_id = 3;
        $product19->save();

        $product20 = new Product;
        $product20->name = "Empanada Tortilla";
        $product20->price = 3;
        $product20->bag_quantity = 6;
        $product20->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product20->category_id = 2;
        $product20->save();
    }
}
