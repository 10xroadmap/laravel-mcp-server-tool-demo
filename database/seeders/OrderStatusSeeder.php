<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['1', 'Noodles', 'PENDING'],
            ['2', 'Sauce', 'PROCESSING'],
            ['3', 'Samsung S24', 'READY_FOR_SHIPMENT'],
            ['4', 'T Shirt', 'SHIPPED'],
            ['5', 'Ear Buds', 'OUT_FOR_DELIVERY'],
            ['6', 'Supplement', 'DELIVERED'],
            ['7', 'Super Noodles ', 'PENDING'],
            ['8', 'Green Sauce', 'PROCESSING'],
            ['9', 'Pixel TAB', 'READY_FOR_SHIPMENT'],
            ['10', 'Trousers', 'SHIPPED'],
        ];
        foreach ($data as $row) {
            OrderStatus::create(
                [
                    'order_id' => $row[0],
                    'product' => $row[1],
                    'status' => $row[2]
                ]
            );
        }
    }
}
