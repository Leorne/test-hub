<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $with = ['answers'];
    protected $hidden = ['created_at', 'updated_at', 'id', 'test_id'];

    public function answers(){
        return $this->hasOne(Answer::class);
    }
}
