<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WordsImport;
use App\Exports\WordsExport;

class WordController extends Controller
{

    // public function index()
    // {
    //     $words = Word::all();

    //     return view('index', ['words' => $words]);
    // }
    
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
        ->where('user_id', Auth::id())
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

    public function list()
    {
        $words = Word::where('user_id', Auth::id())->get();
        // return view('words.list', compact('words'));
        return view('list', compact('words'));
    }

    public function create()
    {
        // return view('words.create');
        return view('create');
    }

    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'english' => 'required|string',
        //     'spanish' => 'required|string',
        //     'french' => 'required|string',
        //     'german' => 'required|string',
        //     'japanese' => 'required|string',
        //     'serbian' => 'required|string',
        //     'category' => 'required|string',
        // ]);

        $validated = $request->validate([
            'English'  => 'string',
            'Spanish'  => 'string',
            'French'   => 'string',
            'German'   => 'string',
            'Japanese' => 'string',
            'Serbian'  => 'string',
            'category' => 'string',
        ]);
        

        Word::create($validated);

        // return redirect()->route('words.index')->with('success', 'Word created successfully.');
        return redirect()->route('list')->with('success', 'Word created successfully.');
    }

    public function edit(Word $word)
    {
        // return view('words.edit', compact('word'));
        return view('edit', compact('word'));
    }

    public function update(Request $request, Word $word)
    {
        // $validated = $request->validate([
        //     'english' => 'required|string',
        //     'spanish' => 'required|string',
        //     'french' => 'required|string',
        //     'german' => 'required|string',
        //     'japanese' => 'required|string',
        //     'serbian' => 'required|string',
        //     'category' => 'required|string',
        // ]);

        $validated = $request->validate([
            'English'  => 'string',
            'Spanish'  => 'string',
            'French'   => 'string',
            'German'   => 'string',
            'Japanese' => 'string',
            'Serbian'  => 'string',
            'category' => 'string',
        ]);
        

        $word->update($validated);

        // return redirect()->route('words.index')->with('success', 'Word updated successfully.');
        return redirect()->route('list')->with('success', 'Word updated successfully.');
    }

    public function destroy(Word $word)
    {
        $word->delete();

        // return redirect()->route('words.index')->with('success', 'Word deleted successfully.');
        return redirect()->route('list')->with('success', 'Word deleted successfully.');
    }
    

}
