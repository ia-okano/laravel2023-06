<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptedReport extends Model
{
    use HasFactory;
    /* content カラムを暗号化するキャスト設定 */
    protected $casts = [
        'content' => 'encrypted',
    ];

}
