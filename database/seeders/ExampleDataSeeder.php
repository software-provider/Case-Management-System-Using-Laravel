<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // add admin account
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'account_status'  => 'Active',
            'account_type' => 'Admin',
            'phone' => '0123456789',
            'address' => 'United States of America',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // add example marketplace account
        DB::table('marketplaces')->insert([
            'marketplace_name' => 'Amazon',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // add example representatives account
        DB::table('representatives')->insert([
            'representative_name' => 'Example Representative',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
