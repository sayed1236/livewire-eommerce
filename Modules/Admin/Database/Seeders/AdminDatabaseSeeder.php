<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PagesMnusSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(StaticPagesSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(SettingMsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SpecialSettingSeeder::class);


    }
}
