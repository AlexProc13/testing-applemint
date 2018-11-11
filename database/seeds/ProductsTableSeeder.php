<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new \DateTime();
        $defaut = [
            [
                'id' => 1,
                'name' => 'product1',
                'description' => 'description1',
                'category_id' => 1,
                'price' => 122,
                'quantity' => 100,
                'state' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 2,
                'name' => 'product2',
                'description' => 'description2',
                'category_id' => 1,
                'price' => 50,
                'quantity' => 13,
                'state' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ];

        Product::insert($defaut);
    }
}
