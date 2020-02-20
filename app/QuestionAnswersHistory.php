<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswersHistory extends Model
{
    protected $guarded = [];
    protected $casts = [
        'answer' => 'array',
    ];
}
