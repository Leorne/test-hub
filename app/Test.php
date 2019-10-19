<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = [];
    protected $with = ['questions', 'tags'];

    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'test_tag');
    }
}
