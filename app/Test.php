<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = [];
    protected $with = ['tags'];
    protected $withCount = ['allVersions'];
    protected static function boot()
    {
        parent::boot();
        static::created(function ($test) {
            TestVersion::create([
                'test_id' => $test->id
            ]);
        });
        static::with('version');

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
//        $this->getLastVersion()
        return $version ? $this->getVersion($version) : $this->getVersion($this->all_versions_count);
    }

    public function getLastVersion()
    {
        return $this->hasOne(TestVersion::class)->latest();
    }

    public function getVersion($version) {
        return $this->hasOne(TestVersion::class)->where('id', $version)->get();
    }

    public function allVersions(){
        return $this->hasMany(TestVersion::class);
    }

    public function getLatestVersion(){
        return TestVersion::where('id',$this->id)->latest()->first();
    }
}
