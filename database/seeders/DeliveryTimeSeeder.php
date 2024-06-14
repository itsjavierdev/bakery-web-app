<?php

namespace Database\Seeders;

use App\Models\DeliveryTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery_time_1 = new DeliveryTime();
        $delivery_time_1->time = '08:00:00';
        $delivery_time_1->for_delivery = 1;
        $delivery_time_1->save();

        $delivery_time_2 = new DeliveryTime();
        $delivery_time_2->time = '09:00:00';
        $delivery_time_2->save();

        $delivery_time_3 = new DeliveryTime();
        $delivery_time_3->time = '10:00:00';
        $delivery_time_3->save();

        $delivery_time_4 = new DeliveryTime();
        $delivery_time_4->time = '11:00:00';
        $delivery_time_4->save();

        $delivery_time_5 = new DeliveryTime();
        $delivery_time_5->time = '12:00:00';
        $delivery_time_5->for_delivery = 1;
        $delivery_time_5->save();

        $delivery_time_6 = new DeliveryTime();
        $delivery_time_6->time = '13:00:00';
        $delivery_time_6->save();

        $delivery_time_7 = new DeliveryTime();
        $delivery_time_7->time = '14:00:00';
        $delivery_time_7->for_delivery = 1;
        $delivery_time_7->save();

        $delivery_time_8 = new DeliveryTime();
        $delivery_time_8->time = '15:00:00';
        $delivery_time_8->save();

        $delivery_time_9 = new DeliveryTime();
        $delivery_time_9->time = '16:00:00';
        $delivery_time_9->save();

        $delivery_time_10 = new DeliveryTime();
        $delivery_time_10->time = '17:00:00';
        $delivery_time_10->for_delivery = 1;
        $delivery_time_10->save();

        $delivery_time_11 = new DeliveryTime();
        $delivery_time_11->time = '18:00:00';
        $delivery_time_11->save();
    }
}
