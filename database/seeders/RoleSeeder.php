<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->upsert([
            [
                'id' => config('global.role.admin'),
                'slug' => 'admin',
                'name' => 'Admin',
                'created_at' => new \DateTime(),
            ],
            [
                'id' => config('global.role.customer'),
                'slug' => 'customer',
                'name' => 'Customer',
                'created_at' => new \DateTime(),
            ]
        ],['id']);
    }
}
