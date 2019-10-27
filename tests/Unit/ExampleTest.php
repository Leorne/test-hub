<?php

namespace Tests\Unit;

use App\Answer;
use App\Tag;
use App\Test;
use App\TestTag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $test = Test::create([
            'title' =>'title',
            'about' => 'about',
            'timer' => null,
            'full_result' => false,
        ])->fresh();
        dd($test->version->id);
    }
}
