<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i=50;
        Product::create([
            'name'=>'Gifts & Crafts',
            // 'Product_id'=>1,
            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
        Product::create([
            'name'=>'Fireworks & Firecrackers
            ',
            // 'Product_id'=>1,

            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
        Product::create([
            'name'=>'Gift Cards
            ',
            // 'Product_id'=>1,

            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
        Product::create([
            'name'=>'Metal Crafts
            ',
            // 'Product_id'=>1,
            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
        Product::create([
            'name'=>'Resin Crafts
            ',
            // 'Product_id'=>1,
            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
        Product::create([
            'name'=>'Wood Crafts
            ',
            // 'Product_id'=>1,
            'img'=>'1013_01_18_09_01_13_ahthyh.jpg',
        ]);
    }
}
