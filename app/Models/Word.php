<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'Dutch', 
        'Japanese_hiragana', 
        'Japanese_romaji', 
        'is_active', 
        'category', 
        'user_id'
    ];

    // キャストを指定（例: boolean型など）
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        // レコードが作成される前に自動的にuser_idを追加
        static::creating(function ($word) {
            $word->user_id = Auth::id();
        });
    }
}
