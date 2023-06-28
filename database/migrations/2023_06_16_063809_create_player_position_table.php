<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /* players モデルと positions モデルの中間テーブルとして利用する
         * 関連付けるテーブルの単数形をアンダースコアでつなげた形にするのがデフォルト
         * テーブル名はアルファベット順で並べる(今回はplayerの方がアルファベット順で早いので先に記述)
         */
        Schema::create('player_position', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('player_id'); /* players テーブルのidを指定するカラム */
            $table->bigInteger('position_id'); /* positions テーブルのidを指定するカラム */
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_position');
    }
};
