<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Test;
use App\Models\TestTag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function testBasicTest()
    {
//        Artisan::call('db:seed');
//        dd(Question::find(1));
    }
}
