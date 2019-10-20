<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $casts = [
      'answer_data' => 'array',
    ];
}
