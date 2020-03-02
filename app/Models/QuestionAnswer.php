<?php

namespace App\Models;

use App\Models\Answers\ChooseAnswer;
use App\Models\Answers\InputNumber;
use App\Models\Answers\InputString;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $with = ['chooseAnswer', 'inputString', 'inputNumber'];

    public function answer()
    {
        return $this->morphTo();
    }


}
