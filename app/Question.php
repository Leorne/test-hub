<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $with = ['answers'];
    protected $hidden = ['created_at', 'updated_at', 'id', 'test_id'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function($question){
            $question->answers->delete();
        });
    }

    public function answers(){
        return $this->hasOne(Answer::class);
    }
}
