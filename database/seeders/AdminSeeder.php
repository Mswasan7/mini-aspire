<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->upsert([
            [
                'id' => config('global.admin.default_user_id'),
                'first_name' => 'Super Admin',
                'last_name' => 1,
                'email' => config('global.admin.default_email'),
                'password' => Hash::make(config('global.admin.default_password')),
            ]
        ],['id']);

        $user = User::find(config('global.admin.default_user_id'));

        //Assign Roles to Admin User

        $user->roles()->attach([config('global.role.admin')]);

        //Assign Permissions to Admin User

        $user->permissions()->attach([
            config('global.permission.loan.create'),
            config('global.permission.loan.view'),
            config('global.permission.loan.approve'),
            config('global.permission.loan.repayment')
        ]);
        $user->save();
    }
}
