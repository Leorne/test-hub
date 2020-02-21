<?php

namespace App\Models;

use App\Models\QuestionAnswersHistory;
use Illuminate\Database\Eloquent\Model;

class TestHistory extends Model
{
    protected $with = ['answersHistory'];
    protected $guarded = [];

    public function answersHistory()
    {
        return $this->hasMany(QuestionAnswersHistory::class, 'test_history_id');
    }
}
