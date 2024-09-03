<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'default_question_language',
        'default_answer_language',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
