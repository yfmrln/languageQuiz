<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class WordsExport extends Model
// {
//     use HasFactory;
// }

use Maatwebsite\Excel\Concerns\FromCollection;

class WordsExport implements FromCollection
{
    public function collection()
    {
        return Word::all();
    }
}
