<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\Team;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gaurd_name=Guard::getDefaultName(static::class);
        $role=Role::where('name','Super Admin')->first();
        //our admin for support
        $user_p=User::create(
            array(
                'member_plan' => 'Hi-Admin',
                'name' => 'puresoft',
                'last_name' => ' ',
                'user_name' => 'PureSoft',
                'role_id'=> $role->id,
                'email' => 'puresoft@'.config('app.user_account_account').'.com',
                'mobile' => '002011117818079',
                'email_verified_at' => now(),
                'password' => Hash::make('puresoft@'.date('nY'.'"')),

            )
        );
        // create team user
        Team::create(
            [
                'user_id'       => $user_p->id,
                'name'          => $user_p->name."'s Team",
                'personal_team' => 1
            ]
        );
        // add permissions
        $user_p->assignRole('Super Admin');
        $permissons=Permission::all()->pluck('name');
        $role->givePermissionTo($permissons);

        //super admin
        $user=User::create(
            array(
                'member_plan' => 'Hi-Admin',
                'name' => 'admin',
                'last_name' => ' ',
                'user_name' => 'admin',
                'role_id'=> $role->id,
                'email' => 'admin@'.config('app.user_account_account').'.com',
                'mobile' => '00201551451595',
                'email_verified_at' => now(),
                'password' => Hash::make('admin@'.date('nY').'"'),

            )
        );
        // create team user
        Team::create(
            [
                'user_id'       => $user->id,
                'name'          => $user->name."'s Team",
                'personal_team' => 1
            ]
        );
        // add permissions
        $user->assignRole('Super Admin');
        $permissons=Permission::all()->pluck('name');
        $role->givePermissionTo($permissons);

        //////
        $role2=Role::where('name','Admin MemberShip')->first();
        $user_company=User::create(
            array(
                'member_plan' => 'Admin MemberShip',
                'name' => 'Admin MemberShip',
                'last_name' => ' ',
                'user_name' => 'Admin',
                'role_id'=> $role2->id,
                'email' => 'admin2@'.config('app.user_account_account').'.com',
                'mobile' => '00201163474777',
                'email_verified_at' => now(),
                'password' => Hash::make('admin@'.date('nY').'"'),

            )
        );
        // create team user_company
        Team::create(
            [
                'user_id'       => $user_company->id,
                'name'          => $user_company->name."'s Team",
                'personal_team' => 1
            ]
        );
        // add permissions
        $permissons=Permission::all()->pluck('name');
        $role->givePermissionTo($permissons);
    }
}
