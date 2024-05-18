<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\SettingMs;
use Illuminate\Database\Seeder;

class SettingMsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingMs::create(
            array(
                'name' => 'اسم الموقع',
                'name_en' => 'site name',
                'tel' => '01063474777',
                'mobile' => '01117818079',
                'email' => 'puresoft.co@gmail.com',
                'address' => 'العنوان هنا',
                'address_en' => 'address en',
                'img' => 'logo.png',
                'is_active' => 'N',
            )
        );
    }
}
