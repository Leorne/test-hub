<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'id', 'question_id'];
    protected $casts = [
      'answer_data' => 'array',
    ];
}
