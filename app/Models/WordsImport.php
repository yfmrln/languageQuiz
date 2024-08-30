<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class WordsImport extends Model
// {
//     use HasFactory;
// }


use Maatwebsite\Excel\Concerns\ToModel;

class WordsImport implements ToModel
{
    public function model(array $row)
    {
        return new Word([
            'English' => $row[0],
            'Spanish' => $row[1],
            'French' => $row[2],
            'German' => $row[3],
            'Japanese' => $row[4],
            'Serbian' => $row[5],
            'category' => $row[6],
            'is_active' => $row[7],
            'user_id' => auth()->id(),
        ]);
    }
}