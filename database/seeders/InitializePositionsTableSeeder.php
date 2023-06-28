<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
/* データベースへのレコード追加のために、DBファサードを利用する */
use Illuminate\Support\Facades\DB;

class InitializePositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert(
            [
                ['name' => 'フォワード'],
                ['name' => 'ミッドフィルダー'],
                ['name' => 'ボランチ'],
                ['name' => 'ディフェンダー'],
                ['name' => 'キーパー'],
            ]
        );

    }
}
