// script.js

$(document).ready(function () {
    let currentQuestion = null;
    let attempts = 0;

    // 初期画面読み込み時
    function loadNextQuestion() {
        const questionLanguage = $('#question-language').val();
        const answerLanguage = $('#answer-language').val();
        const orderType = $('#order-switch').is(':checked') ? 'random' : 'sequential';


        // AJAXリクエストでランダムな問題を取得
        $.ajax({
            url: '/languageQuiz/public/get-random-word',
            method: 'GET',
            data: {
                questionLanguage: questionLanguage,
                answerLanguage: answerLanguage,
                orderType: orderType
            },
            success: function (data) {
                currentQuestion = data;
                if(currentQuestion[questionLanguage] == "") {
                    $('#question-word').text('no data please add data');
                } else {
                    $('#question-word').text(currentQuestion[questionLanguage]);
                }
                $('#answer-input').val('');
                $('#result').text('');
                attempts = 0;
            },
            error: function() {
                $('#word-display').text('Error fetching word');
            }
        });
    }

    // 言語を変更したとき
    $('#question-language').change(function() {
        var questionLanguage = $(this).val();
        var answerLanguage = $('#answer-language').val(); // 答えの言語も必要ならば
        var orderType = $('#order-switch').is(':checked') ? 'random' : 'sequential';


        $.ajax({
            url: '/languageQuiz/public/get-random-word',
            type: 'GET',
            data: {
                questionLanguage: questionLanguage,
                answerLanguage: answerLanguage,
                orderType: orderType
            },
            // success: function(response) {
            //     $('#word-display').text(response[questionLanguage]); // 選択された言語に基づいて単語を表示
            // },
            success: function (data) {
                currentQuestion = data;
                if(currentQuestion[questionLanguage] == null) {
                    $('#question-word').text('no data please add data');
                } else {
                    $('#question-word').text(currentQuestion[questionLanguage]);
                }
                $('#answer-input').val('');
                $('#result').text('');
                attempts = 0;
            },
            error: function() {
                $('#word-display').text('Error fetching word');
            }
        });
    });

    // 言語や順番の変更時にも再読み込み
    $('#order-type').change(function() {
        loadNextQuestion();
    });


    // // 言語や順番の変更時にも再読み込み
    // $('#question-language, #answer-language, #order-type').change(function() {
    //     loadNextQuestion();
    // });

    // 音声再生
    // $('#play-audio').click(function() {
    //     var audioUrl = $(this).data('audio');
    //     if (audioUrl) {
    //         var audio = new Audio(audioUrl);
    //         audio.play();
    //     } else {
    //         alert('No audio available for this word.');
    //     }
    // });
    // 音声ボタンをクリックしたときに音声を再生
    $('#play-audio').click(function() {
        var text = $('#question-word').text();
        var lang = $('#question-language').val();
        // speak(text, lang);
        //console.log('text='+text+"   lang="+lang);
        speakWord(text, getLanguageCode(lang));
    });

    // // 解答ボタンを押したとき
    // $('#check-answer').click(function () {
    //     const userAnswer = $('#answer-input').val().trim();
    //     const answerLanguage = $('#answer-language').val();

    //     if (userAnswer.toLowerCase() === currentQuestion[answerLanguage].toLowerCase()) {
    //         $('#result').text('Correct!').css('color', 'green');
    //         setTimeout(loadNextQuestion, 1000);
    //     } else {
    //         attempts++;
    //         $('#result').text('Incorrect!').css('color', 'red');

    //         if (attempts >= 3) {
    //             $('#result').text(`Incorrect! The correct answer is: ${currentQuestion[answerLanguage]}`).css('color', 'red');
    //             setTimeout(loadNextQuestion, 2000);
    //         }
    //     }
    // });

    //　次の問題を押したとき
    $('#next-question').click(loadNextQuestion);

    // ページロード時に最初の質問をロード
    loadNextQuestion();

    function speakWord(word, languageCode) {
        // if (!window.peechSynthesis) {
        //     alert('Speech synthesis not supported');
        //     return;
        // }

        const utterance = new SpeechSynthesisUtterance(word);
        utterance.lang = languageCode;
        speechSynthesis.speak(utterance);
    }
    
    // 解答ボタンを押したとき
    $('#check-answer').click(function () {
        const userAnswer = $('#answer-input').val().trim();
        const answerLanguage = $('#answer-language').val();
    
        if (userAnswer.toLowerCase() === currentQuestion[answerLanguage].toLowerCase()) {
            $('#result').text('Correct!').css('color', 'green');
            speakWord(currentQuestion[answerLanguage], getLanguageCode(answerLanguage));
            //console.log('text='+currentQuestion[answerLanguage]+"   lang="+answerLanguage);
            setTimeout(loadNextQuestion, 1000);
        } else {
            attempts++;
            $('#result').text('Incorrect!').css('color', 'red');
    
            if (attempts >= 3) {
                $('#result').text(`Incorrect! The correct answer is: ${currentQuestion[answerLanguage]}`).css('color', 'red');
                speakWord(currentQuestion[answerLanguage], getLanguageCode(answerLanguage));
                setTimeout(loadNextQuestion, 2000);
            }
        }
    });
    
    function getLanguageCode(language) {
        switch(language) {
            case 'English': return 'en';
            case 'Spanish': return 'es';
            case 'French': return 'fr';
            case 'German': return 'de';
            case 'Japanese': return 'ja';
            case 'Serbian': return 'sr';
            case 'Dutch': return 'nl';
            case 'Japanese_hiragana': return 'ja';
            case 'Japanese_romaji': return 'ja';
            default: return 'en';
        }
    }

    // CSRFトークンを取得
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // チェックボックスが変更されたときの処理
    $('.word-checkbox').on('change', function() {
        var checkbox = $(this);
        var wordId = checkbox.data('id');
        var isActive = checkbox.is(':checked') ? 1 : 0;

        $.ajax({
            url: '/languageQuiz/public/words/' + wordId + '/is_active',
            method: 'POST',
            data: {
                _token: csrfToken,
                is_active: isActive
            },
            success: function(response) {
                console.log('Update successful:', response);
            },
            error: function(xhr) {
                console.error('Update failed:', xhr.responseText);
            }
        });
    });

    
});

// // activeチェックボックスのつけ外し
// document.addEventListener('DOMContentLoaded', function () {
//     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//     document.querySelectorAll('.word-checkbox').forEach(function (checkbox) {
//         checkbox.addEventListener('change', function () {
//             const wordId = this.getAttribute('data-id');
//             const isActive = this.checked ? 1 : 0;

//             fetch(`/words/${wordId}/is_active`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': csrfToken
//                 },
//                 body: JSON.stringify({ is_active: isActive })
//             }).then(response => response.json())
//               .then(data => {
//                   console.log('Update successful:', data);
//               }).catch(error => {
//                   console.error('Error:', error);
//               });
//         });
//     });
// });
