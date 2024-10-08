<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [WordController::class, 'getRandomWord']);
// Route::get('/', function () {
//     // return view('index');
// })->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/quiz', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('quiz');

require __DIR__.'/auth.php';

// quiz画面
Route::get('/', [WordController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/dashboard', [WordController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/quiz', [WordController::class, 'index'])->middleware(['auth', 'verified'])->name('quiz');

// list画面
Route::get('/list', [WordController::class, 'list'])->middleware(['auth', 'verified'])->name('list');

//プロフィール設定
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/get-random-word', [WordController::class, 'getRandomWord']);

Route::get('/words', [WordController::class, 'list'])->name('words.list');
Route::get('/words/create', [WordController::class, 'create'])->name('words.create');
Route::post('/words', [WordController::class, 'store'])->name('words.store');
Route::get('/words/{word}/edit', [WordController::class, 'edit'])->name('words.edit');
Route::put('/words/{word}', [WordController::class, 'update'])->name('words.update');
Route::delete('/words/{word}', [WordController::class, 'destroy'])->name('words.destroy');

// CSV 
Route::get('/words/export', [WordController::class, 'exportCsv'])->name('words.export');
Route::post('/words/import', [WordController::class, 'importCsv'])->name('words.import');

Route::post('/words/{id}/is_active', [WordController::class, 'is_active'])->name('words.is_active');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update')->middleware('auth');

