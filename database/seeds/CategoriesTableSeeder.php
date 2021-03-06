<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'name' => 'category1',
                'description' => 'description2',
                'alias' => 'ct1',
                'state' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'id' => 2,
                'name' => 'category2',
                'description' => 'description2',
                'alias' => 'ct2',
                'state' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ];

        Category::insert($defaut);
    }
}
