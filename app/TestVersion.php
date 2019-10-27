<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestVersion extends Model
{
    protected $guarded = [];
    protected $with = ['questions'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
