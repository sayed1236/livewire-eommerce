<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\SpecialSetting;
use Illuminate\Database\Seeder;

class SpecialSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialSetting::create(
            array(
                'seo' => '0',
                'lang' => 'Y',
                'color' => '#090101',
            )
        );
    }
}
