<?php

namespace Tests\Unit;

use App\Answer;
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
        $this->assertTrue(true);
    }


    /** @test */
    function dbseed()
    {
        $ans = factory('App\Answer', 'one_answer.correct', 1)->create([
            'question_id' => 20]);
        dd($ans);
    }
}
