<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Answers\ChooseAnswer;
use App\Models\Answers\InputNumber;
use App\Models\Answers\InputString;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $with = ['chooseAnswer', 'inputString', 'inputNumber'];
    protected $hidden = ['created_at', 'updated_at', 'test_version_id', 'inputNumber', 'inputString', 'chooseAnswer'];
    protected $appends = ['answers'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($question) {
            $question->answers->delete();
        });
    }

//    public function answers()
//    {
//        return $this->hasMany(QuestionAnswer::class, 'question_id', 'id');
//    }

    public function inputString()
    {
        return $this->morphedByMany(InputString::class, 'answer', 'question_answers');
    }

    public function chooseAnswer()
    {
        return $this->morphedByMany(ChooseAnswer::class, 'answer', 'question_answers');
    }

    public function inputNumber()
    {
        return $this->morphedByMany(InputNumber::class, 'answer', 'question_answers');
    }

    public function getAnswersAttribute()
    {
        return $this->chooseAnswer->merge($this->inputString)->merge($this->inputNumber);
    }

}
