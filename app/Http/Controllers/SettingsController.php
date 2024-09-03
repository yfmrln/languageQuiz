<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $languages = ['English', 'Spanish', 'French', 'German', 'Japanese', 'Serbian',
        'Dutch', 'Japanese_hiragana', 'Japanese_romaji'];

        $userSetting = UserSetting::firstOrCreate(
            ['user_id' => $user->id],
            ['default_question_language' => 'English', 'default_answer_language' => 'English']
        );

        return view('settings.index', compact('userSetting', 'languages'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'default_question_language' => 'required|string|max:255',
            'default_answer_language' => 'required|string|max:255',
        ]);

        $userSetting = UserSetting::where('user_id', $user->id)->first();
        $userSetting->update($validated);

        return redirect()->route('settings')->with('success', 'Settings updated successfully.');
    }
}
