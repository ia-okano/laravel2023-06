<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InjectionTestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('injection_test_users')->insert(
            [
                ['name' => 'user01', 'password' => 'abcde'],
                ['name' => 'user02', 'password' => 'abcde'],
                ['name' => 'user03', 'password' => 'abcde'],
                ['name' => 'user04', 'password' => 'abcde'],
                ['name' => 'user05', 'password' => 'abcde'],
            ]
        );
    }

}
