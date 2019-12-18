<?php

function create($class,$attribute = []){
    return factory($class)->create($attribute);
}
function make($class,$attribute = []){
    return factory($class)->make($attribute);
}
function raw($class,$attribute = []){
    return factory($class)->raw($attribute);
}


function makeTestData(){

    $test = make('App\Test');
    $questionData = [];
    $tags[] = make('App\Tag')->toArray();
    $tags[] = make('App\Tag')->toArray();
    $tags[] = make('App\Tag')->toArray();

    for($i = 0; $i<5; $i++){
        $question = raw('App\Question', ['question_type' => 'one_answer']);
        $result = [
            'question_body' => $question['question_body'],
            'question_type' => $question['question_type'],
            'question_points' => $question['question_points'],
        ];
        $result['answer_data'][] = $answer = factory('App\Answer', 'one_answer')->raw();
        $result['answer_data'][] = $answer = factory('App\Answer', 'one_answer')->raw();
        $result['answer_data'][] = $answer = factory('App\Answer', 'one_answer')->raw();
        $questionData[] = $result;
    }

    $data = [
        "title" => $test->title,
        "about" => $test->about,
        "timer" => null,
        "full_result" => false,
        "tags" => $tags,
        "questions" => $questionData,
    ];
    return $data;
}
