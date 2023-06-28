<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
/* モデルに設定した暗号化の機能を利用するので、EncryptedReports モデルを読み込みする */
use App\Models\EncryptedReport;

class EncryptedReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = new EncryptedReport();
        $data->author = 'ユーザー001';
        $data->content = 'おはようございます';
        $data->save();

        $data = new EncryptedReport();
        $data->author = 'ユーザー002';
        $data->content = 'こんにちは';
        $data->save();

        $data = new EncryptedReport();
        $data->author = 'ユーザー003';
        $data->content = 'こんばんは';
        $data->save();

    }
}
