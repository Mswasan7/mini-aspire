<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('system_settings')->upsert([
            [
                'id' => config('global.system_settings.name.cancelled'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'Cancelled',
                'short_description' => 'Loan Status Cancelled',
                'order_value' => 1
            ],
            [
                'id' => config('global.system_settings.name.refunded'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'Refunded',
                'short_description' => 'Loan Status Refunded',
                'order_value' => 2
            ],
            [
                'id' => config('global.system_settings.name.pending'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'pending',
                'short_description' => 'Loan Status Pending',
                'order_value' => 3
            ],
            [
                'id' => config('global.system_settings.name.approved'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'Approved',
                'short_description' => 'Loan Status Approved',
                'order_value' => 4
            ],
            [
                'id' => config('global.system_settings.name.processing'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'Processing',
                'short_description' => 'Loan Status Processing',
                'order_value' => 5
            ],
            [
                'id' => config('global.system_settings.name.paid'),
                'group_id' => config('global.system_settings.group.loan_status'),
                'name' => 'Paid',
                'short_description' => 'Loan Status Paid',
                'order_value' => 6
            ],
        ],['id']);
    }
}
