<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\StaticPage;
use Illuminate\Database\Seeder;

class StaticPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=1;
        for ($i=0; $i < 20 ; $i++) {
            StaticPage::create(
                array(
                    'ord' => $i,
                    'name' => 'اضف  الصفحه',
                    'name_en' => 'add page',
                    'img' => '',
                    'is_active' => 'N',

                )
            );
        }

    }
}
