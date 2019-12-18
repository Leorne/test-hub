<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::deleting(function($tag){
            TestTag::where('id',$tag->id)->delete();
        });
    }

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at','approved'];

}
