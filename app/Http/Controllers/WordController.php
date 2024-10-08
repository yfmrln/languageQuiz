<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\UserSetting;
use Illuminate\Http\Request;
// use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\WordsImport;
// use App\Exports\WordsExport;

class WordController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        $userSetting = UserSetting::where('user_id', $user->id)->first();
        
        // デフォルトの言語を設定
        if ($userSetting === null) {
            $defaultQuestionLanguage = "English";
            $defaultAnswerLanguage = "English";
        } else {
            $defaultQuestionLanguage = $userSetting->default_question_language ?? "English";
            $defaultAnswerLanguage = $userSetting->default_answer_language ?? "English";
        }



        return view('index', compact('defaultQuestionLanguage', 'defaultAnswerLanguage'));
    }
    
    public function getRandomWord(Request $request)
    {

        $questionLanguage = $request->get('questionLanguage');
        $answerLanguage = $request->get('answerLanguage');
        $orderType = $request->get('orderType', 'random');
        // $userId = Auth::id();

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

        // if ($orderType == 'random') {
        //     $word = $query->inRandomOrder()->first();
        // } else {
        //     // 順番に出題するため、セッションでトラッキング
        //     $lastWordId = session()->get('last_word_id');
        //     if ($lastWordId) {
        //         $word = $query->where('id', '<', $lastWordId)->orderBy('id', 'desc')->first();
        //     }
        //     if (!$word) {
        //         // 最後まで行ったら最初に戻る
        //         $word = $query->orderBy('id', 'desc')->first();
        //     }
        // }

        if ($word) {
            return response()->json($word);
        }

        return response()->json(['message' => 'No words found'], 404);
        
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
            'English'           => 'nullable|string',
            'Spanish'           => 'nullable|string',
            'French'            => 'nullable|string',
            'German'            => 'nullable|string',
            'Japanese'          => 'nullable|string',
            'Serbian'           => 'nullable|string',
            'Dutch'             => 'nullable|string',
            'Japanese_hiragana' => 'nullable|string',
            'Japanese_romaji'   => 'nullable|string',
            'category'          => 'string',
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
            'English'           => 'nullable|string',
            'Spanish'           => 'nullable|string',
            'French'            => 'nullable|string',
            'German'            => 'nullable|string',
            'Japanese'          => 'nullable|string',
            'Serbian'           => 'nullable|string',
            'Dutch'             => 'nullable|string',
            'Japanese_hiragana' => 'nullable|string',
            'Japanese_romaji'   => 'nullable|string',
            'category'          => 'string',
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

    // public function export() 
    // {
    //     return Excel::download(new WordsExport, 'words.csv');
    // }

    // public function import(Request $request) 
    // {
    //     $request->validate(['csv_file' => 'required|file|mimes:csv,txt']);
    //     Excel::import(new WordsImport, $request->file('csv_file'));
    //     return redirect()->route('words.index')->with('success', 'Words Imported Successfully!');
    // }

        // CSVダウンロード用
        public function exportCsv()
        {
            $words = Word::where('user_id', Auth::id())->get();
    
            // ヘッダー
            $csvData = "English,Spanish,French,German,Japanese,Serbian,Dutch,Japanese_hiragana,Japanese_romaji,Category\n";
    
            // // データ行
            // foreach ($words as $word) {
            //     $csvData .= "{$word->english},{$word->spanish},{$word->french},{$word->german},{$word->japanese},{$word->serbian},{$word->category}\n";
            // }
    
            // CSVの出力
            return response($csvData)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename="words.csv"');
        }
    
        // CSVアップロード用
        public function importCsv(Request $request)
        {
            $file = $request->file('csv_file');
    
            if ($file->isValid()) {
                $filePath = $file->getRealPath();
                $fileHandle = fopen($filePath, 'r');
                
                // CSVのヘッダーをスキップ
                fgetcsv($fileHandle);
    
                // 各行を処理
                while (($data = fgetcsv($fileHandle, 1000, ',')) !== FALSE) {
                    Word::create([
                        'English'           => !empty($data[0]) ? $data[0] : null,
                        'Spanish'           => !empty($data[1]) ? $data[1] : null,
                        'French'            => !empty($data[2]) ? $data[2] : null,
                        'German'            => !empty($data[3]) ? $data[3] : null,
                        'Japanese'          => !empty($data[4]) ? $data[4] : null,
                        'Serbian'           => !empty($data[5]) ? $data[5] : null,
                        'Dutch'             => !empty($data[6]) ? $data[6] : null,
                        'Japanese_hiragana' => !empty($data[7]) ? $data[7] : null,
                        'Japanese_romaji'   => !empty($data[8]) ? $data[8] : null,
                        'category'          => !empty($data[9]) ? $data[9] : null,
                        'user_id'           => Auth::id(),
                        'is_active'         => true,
                    ]);
                }
    
                fclose($fileHandle);
    
                return redirect()->route('words.list')->with('success', 'CSV data imported successfully!');
            }
    
            return redirect()->route('words.list')->with('error', 'Invalid file upload.');
        }

        // public function importCsv(Request $request)
        // {
        //     $request->validate([
        //         'csv_file' => 'required|mimes:csv,txt'
        //     ]);
    
        //     $file = $request->file('csv_file');
        //     $spreadsheet = IOFactory::load($file->getRealPath());
        //     $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
        //     if (empty($sheetData)) {
        //         return redirect()->back()->with('error', 'The CSV file is empty.');
        //     }
    
        //     // 1行目をカラム名として取得
        //     $header = array_shift($sheetData);
            
        //     foreach ($sheetData as $data) {
        //         $wordData = [];
    
        //         // CSVのカラム名をデータベースのカラムにマッピング
        //         foreach ($header as $key => $columnName) {
        //             // カラム名がデータベースのカラムと一致する場合に値を設定
        //             if (array_key_exists($columnName, $data)) {
        //                 $wordData[$columnName] = $data[$columnName] ?? null;
        //             }
        //         }
    
        //         $wordData['user_id'] = Auth::id();
        //         $wordData['is_active'] = true;
    
        //         try {
        //             Word::create($wordData);
        //         } catch (\Exception $e) {
        //             \Log::error('Failed to import data: ' . $e->getMessage());
        //         }
        //     }
    
        //     return redirect()->route('words.list')->with('success', 'CSV data imported successfully!');
        // }

        // is_activeのつけ外し
        public function is_active(Request $request, $id)
        {
            $request->validate([
                'is_active' => 'required|boolean',
            ]);
    
            $word = Word::findOrFail($id);
            $word->is_active = $request->input('is_active');
            $word->save();
    
            return response()->json(['success' => true]);
        }
    

}
