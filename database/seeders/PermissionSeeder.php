<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->upsert([
            [
                'id' => config('global.permission.loan.create'),
                'slug' => 'create-loan',
                'name' => 'Create Loan',
                'created_at' => new \DateTime(),
            ],
            [
                'id' => config('global.permission.loan.view'),
                'slug' => 'view-loan',
                'name' => 'View Loan',
                'created_at' => new \DateTime(),
            ],
            [
                'id' => config('global.permission.loan.approve'),
                'slug' => 'approve-loan',
                'name' => 'Approve Loan',
                'created_at' => new \DateTime(),
            ],
            [
                'id' => config('global.permission.loan.repayment'),
                'slug' => 'repayment-loan',
                'name' => 'Repayment Loan',
                'created_at' => new \DateTime()
            ]
        ],['id']);

         //Assign Admin Role with Permissions

        $adminRole = Role::find(config('global.role.admin'));
        $adminRole->permissions()->attach([
            config('global.permission.loan.create'),
            config('global.permission.loan.view'),
            config('global.permission.loan.approve'),
            config('global.permission.loan.repayment')
        ]);

        //Assign Customer Role with Permissions
        $customerRole = Role::find(config('global.role.customer'));
        $customerRole->permissions()->attach([
            config('global.permission.loan.create'),
            config('global.permission.loan.view'),
            config('global.permission.loan.repayment')
        ]);


    }
}
