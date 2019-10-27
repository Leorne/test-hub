<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = [];
    protected $with = ['tags', 'version'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($test) {
            TestVersion::create([
                'test_id' => $test->id
            ]);
        });

    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'test_tag');
    }

    public function version($version = null)
    {
        return $version ? $this->getVersion($version) : $this->getLastVersion();
    }

    public function getLastVersion()
    {
        return $this->hasOne(TestVersion::class)->latest();
    }

    public function getVersion($version) {
        return $this->hasOne(TestVersion::class)->where('id', $version);
    }
}
