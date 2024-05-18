<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            array(
                'type'=>'0',
                'name' => 'Electronics',
                'is_active' => 'Y',
            )
        );
    }
}
