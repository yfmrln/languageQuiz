<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Quiz</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css')  }}">
</head>
<body>
    <div id="quiz-container">
        <h1>Language Quiz</h1>
        <label for="question-language">Question Language:</label>
        <select id="question-language">
            <option value="English">English</option>
            <option value="Spanish">Spanish</option>
            <option value="French">French</option>
            <option value="German">German</option>
            <option value="Japanese">Japanese</option>
            <option value="Serbian">Serbian</option>
        </select>

        <label for="answer-language">Answer Language:</label>
        <select id="answer-language">
            <option value="English">English</option>
            <option value="Spanish">Spanish</option>
            <option value="French">French</option>
            <option value="German">German</option>
            <option value="Japanese">Japanese</option>
            <option value="Serbian">Serbian</option>
        </select>

        <div id="question-container">
            <p id="question-word"></p>
            <button id="play-audio" class="audio-button">🔊</button><br>
            <input type="text" id="answer-input" placeholder="Enter your answer">
            <button id="check-answer">Check Answer</button>
            <p id="result"></p>
        </div>

        <button id="next-question">Next Question</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/script.js')  }}"></script>
</body>
</html>
