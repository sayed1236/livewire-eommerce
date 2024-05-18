<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Guard;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            array(
                'ord' => Role::where('is_active','Y')->count()+1,
                'name_ar' => 'مستخدم عادي',
                'name' => 'Member',
                'guard_name' => Guard::getDefaultName(static::class),
                'is_active' => 'Y',
            )
        );
        // Role::create(
        //     array(
        //         'ord' => Role::where('is_active','Y')->count()+1,
        //         'name_ar' => 'طالب',
        //         'name' => 'Student',
        //         'guard_name' => Guard::getDefaultName(static::class),
        //         'is_active' => 'Y',
        //     )
        // );
        // Role::create(
        //     array(
        //         'ord' => Role::where('is_active','Y')->count()+1,
        //         'name_ar' => 'ولي امر',
        //         'name' => 'Parent',
        //         'guard_name' => Guard::getDefaultName(static::class),
        //         'is_active' => 'Y',
        //     )
        // );
        // Role::create(
        //     array(
        //         'ord' => Role::where('is_active','Y')->count()+1,
        //         'name_ar' => 'حضانه',
        //         'name' => 'nursery',
        //         'guard_name' => Guard::getDefaultName(static::class),
        //         'is_active' => 'Y',
        //     )
        // );
        // Role::create(
        //     array(
        //         'ord' => Role::where('is_active','Y')->count()+1,
        //         'name_ar' => 'اصحاب الورش',
        //         'name' => 'Owners of workshops',
        //         'guard_name' => Guard::getDefaultName(static::class),
        //         'is_active' => 'Y',
        //     )
        // );
        Role::create(
            array(
                'ord' => Role::where('is_active','Y')->count()+1,
                'name_ar' => 'مدخلي البيانات',
                'name' => 'DataEntry MemberShip',
                'guard_name' => Guard::getDefaultName(static::class),
                'is_active' => 'Y',
            )
        );
        Role::create(
            array(
                'ord' => Role::where('is_active','Y')->count()+1,
                'name_ar' => 'المشرفين',
                'name' => 'Suprevisor MemberShip',
                'guard_name' => Guard::getDefaultName(static::class),
                'is_active' => 'Y',
            )
        );
        Role::create(
            array(
                'ord' => Role::where('is_active','Y')->count()+1,
                'name_ar' => 'مديري الموقع',
                'name' => 'Admin MemberShip',
                'guard_name' => Guard::getDefaultName(static::class),
                'is_active' => 'Y',
            )
        );
        Role::create(
            array(
                'ord' => Role::where('is_active','Y')->count()+1,
                'name_ar' => 'المدير العام',
                'name' => 'Super Admin',
                'guard_name' => Guard::getDefaultName(static::class),
                'is_active' => 'Y',
            )
        );

    }
}
