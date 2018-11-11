<?php

use App\User;
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
        $defautCategories = [
            [
                'name' => 'category1',
                'description' => 'description1',
                'alias' => 'ct1',
                'state' => 1,
            ],
            [
                'name' => 'category2',
                'description' => 'description2',
                'alias' => 'ct2',
                'state' => 1
            ]
        ];

        foreach ($defautCategories as $caterory) {
            Category::create($caterory);
        }
    }
}
