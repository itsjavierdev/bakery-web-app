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
        $product1->name = "Pan de Arroz";
        $product1->price = 0.42;
        $product1->price_by_bag = 10;
        $product1->bag_quantity = 24;
        $product1->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product1->category_id = 3;
        $product1->save();

        $product2 = new Product;
        $product2->name = "Empanada de Arroz";
        $product2->price = 1.67;
        $product2->price_by_bag = 20;
        $product2->bag_quantity = 12;
        $product2->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product2->category_id = 3;
        $product2->save();

        $product3 = new Product;
        $product3->name = "Empanada Pizza";
        $product3->price = 1.67;
        $product3->price_by_bag = 20;
        $product3->bag_quantity = 12;
        $product3->description = 'Rellenas de queso, jamón, salsa de tomate y choclo';
        $product3->category_id = 6;
        $product3->save();

        $product4 = new Product;
        $product4->name = "Marraqueta";
        $product4->price = 2;
        $product4->price_by_bag = 10;
        $product4->bag_quantity = 5;
        $product4->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product4->category_id = 1;
        $product4->save();

        $product5 = new Product;
        $product5->name = "Empanada Tortilla";
        $product5->price = 1.67;
        $product5->price_by_bag = 20;
        $product5->bag_quantity = 12;
        $product5->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product5->category_id = 2;
        $product5->save();

        $product6 = new Product;
        $product6->name = "Churro";
        $product6->price = 1.67;
        $product6->price_by_bag = 20;
        $product6->bag_quantity = 12;
        $product6->description = 'Rellenas de queso, jamón, salsa de tomate y choclo';
        $product6->category_id = 2;
        $product6->save();

        $product7 = new Product;
        $product7->name = "Tortilla";
        $product7->price = 1.67;
        $product7->price_by_bag = 20;
        $product7->bag_quantity = 12;
        $product7->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product7->category_id = 2;
        $product7->save();

        $product8 = new Product;
        $product8->name = "Empanada Al Horno";
        $product8->price = 0.83;
        $product8->price_by_bag = 10;
        $product8->bag_quantity = 12;
        $product8->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product8->category_id = 6;
        $product8->save();

        $product9 = new Product;
        $product9->name = "Jochabado";
        $product9->price = 0.83;
        $product9->price_by_bag = 10;
        $product9->bag_quantity = 12;
        $product9->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product9->category_id = 1;
        $product9->save();

        $product10 = new Product;
        $product10->name = "Pan Casero Con Queso";
        $product10->price = 0.42;
        $product10->price_by_bag = 10;
        $product10->bag_quantity = 24;
        $product10->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product10->category_id = 1;
        $product10->save();

        $product11 = new Product;
        $product11->name = "Pan Casero Con Harina";
        $product11->price = 0.42;
        $product11->price_by_bag = 10;
        $product11->bag_quantity = 24;
        $product11->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product11->category_id = 1;
        $product11->save();

        $product12 = new Product;
        $product12->name = "Pan Integral";
        $product12->price = 0.83;
        $product12->price_by_bag = 10;
        $product12->bag_quantity = 12;
        $product12->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product12->category_id = 4;
        $product12->save();

        $product13 = new Product;
        $product13->name = "Rosquita De Cuñapé";
        $product13->price = 0.83;
        $product13->price_by_bag = 10;
        $product13->bag_quantity = 12;
        $product13->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product13->category_id = 3;
        $product13->save();

        $product14 = new Product;
        $product14->name = "Pan De Canela";
        $product14->price = 0.83;
        $product14->price_by_bag = 10;
        $product14->bag_quantity = 12;
        $product14->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product14->category_id = 4;
        $product14->save();

        $product15 = new Product;
        $product15->name = "Pan Chama";
        $product15->price = 1.67;
        $product15->price_by_bag = 20;
        $product15->bag_quantity = 12;
        $product15->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product15->category_id = 4;
        $product15->save();

        $product16 = new Product;
        $product16->name = "Pan Con Harina";
        $product16->price = 0.83;
        $product16->price_by_bag = 10;
        $product16->bag_quantity = 12;
        $product16->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product16->category_id = 1;
        $product16->save();

        $product17 = new Product;
        $product17->name = "Queque";
        $product17->price = 8;
        $product17->price_by_bag = 8;
        $product17->bag_quantity = 1;
        $product17->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        $product17->category_id = 5;
        $product17->save();

        // $product18 = new Product;
        // $product18->name = "Rosquita de cuñapé";
        // $product18->price = 1;
        // $product1->bag_quantity = 24;
        // $product1->price_by_bag = 10;
        // $product18->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        // $product18->category_id = 3;
        // $product18->save();

        // $product19 = new Product;
        // $product19->name = "rosquitademaiz";
        // $product19->price = 3;
        // $product1->bag_quantity = 24;
        // $product1->price_by_bag = 10;
        // $product19->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        // $product19->category_id = 3;
        // $product19->save();

        // $product20 = new Product;
        // $product20->name = "Empanada Tortilla";
        // $product20->price = 3;
        // $product1->bag_quantity = 24;
        // $product1->price_by_bag = 10;
        // $product20->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, nisi?';
        // $product20->category_id = 2;
        // $product20->save();
    }
}
