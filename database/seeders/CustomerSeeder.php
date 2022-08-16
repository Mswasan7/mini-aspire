<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $customer1 = User::create([
                'first_name' => 'Customer',
                'last_name'  => '1',
                'email'      => 'customer1@gmail.com',
                'password'   =>  Hash::make(config('global.admin.default_password')),
        ]);

       $customer2 = User::create([
                'first_name' => 'Customer',
                'last_name'  => '2',
                'email'      => 'customer2@gmail.com',
                'password'   =>  Hash::make(config('global.admin.default_password')),
        ]);



        //Assign Roles to Customer

        $customer1->roles()->attach([config('global.role.customer')]);
        $customer2->roles()->attach([config('global.role.customer')]);


        //Assign Permissions to Customer
        $customer1->permissions()->attach([
            config('global.permission.loan.create'),
            config('global.permission.loan.view'),
            config('global.permission.loan.repayment')
        ]);
        $customer2->permissions()->attach([
            config('global.permission.loan.create'),
            config('global.permission.loan.view'),
            config('global.permission.loan.repayment')
        ]);
    }
}
