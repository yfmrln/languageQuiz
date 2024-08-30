<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    // このモデルで操作するテーブルの名前を指定します。
    protected $table = 'words';

    // ホワイトリスト方式で、保存可能なカラムを指定します。
    protected $fillable = [
        'English', 
        'Spanish', 
        'French', 
        'German', 
        'Japanese', 
        'Serbian', 
        'is_active', 
        'category', 
        'user_id'
    ];

    // キャストを指定（例: boolean型など）
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
