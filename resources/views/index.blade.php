@extends('layouts.app')

@section('content')
    <div id="quiz-container">
        <h1>Language Quiz</h1>
        <label for="question-language">Question Language:</label>
        <select id="question-language">
            <option value="English" {{ $defaultQuestionLanguage == 'English' ? 'selected' : '' }}>English</option>
            <option value="Spanish" {{ $defaultQuestionLanguage == 'Spanish' ? 'selected' : '' }}>Spanish</option>
            <option value="French" {{ $defaultQuestionLanguage == 'French' ? 'selected' : '' }}>French</option>
            <option value="German" {{ $defaultQuestionLanguage == 'German' ? 'selected' : '' }}>German</option>
            <option value="Japanese" {{ $defaultQuestionLanguage == 'Japanese' ? 'selected' : '' }}>Japanese</option>
            <option value="Serbian" {{ $defaultQuestionLanguage == 'Serbian' ? 'selected' : '' }}>Serbian</option>
            <option value="Dutch" {{ $defaultQuestionLanguage == 'Dutch' ? 'selected' : '' }}>Dutch</option> <!-- オランダ語 -->
            <option value="Japanese_hiragana" {{ $defaultQuestionLanguage == 'Japanese_hiragana' ? 'selected' : '' }}>Japanese Hiragana</option> <!-- 日本語ひらがな -->
            <option value="Japanese_romaji" {{ $defaultQuestionLanguage == 'Japanese_romaji' ? 'selected' : '' }}>Japanese Romaji</option> <!-- 日本語ローマ字 -->
        </select>

        <label for="answer-language">Answer Language:</label>
        <select id="answer-language">
            <option value="English" {{ $defaultAnswerLanguage == 'English' ? 'selected' : '' }}>English</option>
            <option value="Spanish" {{ $defaultAnswerLanguage == 'Spanish' ? 'selected' : '' }}>Spanish</option>
            <option value="French" {{ $defaultAnswerLanguage == 'French' ? 'selected' : '' }}>French</option>
            <option value="German" {{ $defaultAnswerLanguage == 'German' ? 'selected' : '' }}>German</option>
            <option value="Japanese" {{ $defaultAnswerLanguage == 'Japanese' ? 'selected' : '' }}>Japanese</option>
            <option value="Serbian" {{ $defaultAnswerLanguage == 'Serbian' ? 'selected' : '' }}>Serbian</option>
            <option value="Dutch" {{ $defaultAnswerLanguage == 'Dutch' ? 'selected' : '' }}>Dutch</option> <!-- オランダ語 -->
            <option value="Japanese_hiragana" {{ $defaultAnswerLanguage == 'Japanese_hiragana' ? 'selected' : '' }}>Japanese Hiragana</option> <!-- 日本語ひらがな -->
            <option value="Japanese_romaji" {{ $defaultAnswerLanguage == 'Japanese_romaji' ? 'selected' : '' }}>Japanese Romaji</option> <!-- 日本語ローマ字 -->
        </select>

        <!-- <div class="switch-container">
            <label for="order-switch">Random Order:</label>
            <input type="checkbox" id="order-switch" checked>
        </div> -->

        <div id="question-container">   
            <span id="question-word"></span>
            <button id="play-audio" class="audio-button">🔊</button><br>
            <input type="text" id="answer-input" placeholder="Enter your answer">
            <button id="check-answer">Check Answer</button>
            <p id="result"></p>
        </div>

        <button id="next-question">Next Question</button>
    </div>
@endsection

