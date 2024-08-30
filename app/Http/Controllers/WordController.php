<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WordsImport;
use App\Exports\WordsExport;

class WordController extends Controller
{

    public function index()
    {
        $words = Word::all();

        return view('index', ['words' => $words]);
    }
    
    public function getRandomWord(Request $request)
    {
        $questionLanguage = $request->get('questionLanguage');
        $answerLanguage = $request->get('answerLanguage');

        // // ランダムに1つのアクティブな単語を取得
        // $words = Word::where('is_active', true)
        //             ->inRandomOrder()
        //             ->first();

        // return response()->json($words);
        // // return view('index', ['words' => $words]);

        $word = Word::whereNotNull($questionLanguage)
        ->whereNotNull($answerLanguage)
        ->where('is_active', true)
        ->inRandomOrder()
        ->first();

        if ($word) {
            return response()->json($word);
        }

        return response()->json(['message' => 'No words found'], 404);
        
    }

    public function export() 
    {
        return Excel::download(new WordsExport, 'words.csv');
    }

    public function import(Request $request) 
    {
        $request->validate(['csv_file' => 'required|file|mimes:csv,txt']);
        Excel::import(new WordsImport, $request->file('csv_file'));
        return redirect()->route('words.index')->with('success', 'Words Imported Successfully!');
    }
    

}
