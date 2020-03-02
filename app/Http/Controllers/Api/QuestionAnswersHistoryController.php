<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionAnswersHistory;
use App\Models\TestHistory;
use Illuminate\Http\Request;

class QuestionAnswersHistoryController extends Controller
{
    public function store(Request $request)
    {
        $question = Question::findOrFail($request->question_id);
        $history = TestHistory::findOrFail($request->test_history_id);
        $answerData = $request->answer;
        $correct = false;

        if ($question->question_type === 'many_answers') {
            dd($answerData, $question->question_type);
        }elseif($question->question_type === 'one_answer'){
            dd($answerData, $question->question_type);
        }elseif ($question->question_type === 'input_number'){
            $correctAnswer = $question->answers->answer_data;
            if(($correctAnswer['answer'] === $answerData['answer'])){
                $correct = true;
            }
        }elseif ($question->question_type === 'input_string'){
            $correctAnswer = $question->answers->answer_data;
            dd($correctAnswer);
        }else{
            dd($question, 'not type');
        }

        QuestionAnswersHistory::create([
            'test_history_id' => $history->id,
            'question_id' => $question->id,
            'answer' => $answerData,
            'correct' => $correct
        ]);
        return response()->json('', 201);
    }
}
