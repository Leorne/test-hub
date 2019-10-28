<?php

namespace Tests\Feature;

use App\Test;
use App\TestVersion;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_create_test()
    {
        $this->withExceptionHandling();

        $data = makeTestData();
        $result = $this->post('/new', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('tests', [
           'title' => $data['title'],
           'about' => $data['about']
        ]);

        $test = Test::all()->last();
        $this->assertDatabaseHas('test_versions',[
            'id' => $test->version->id,
            'test_id' => $test->id,
        ]);
    }

    /** @test */
    function user_can_edit_test(){
        $this->withExceptionHandling();
        $oldData = makeTestData();
        $this->post('/new', $oldData)
            ->assertStatus(200);

        $oldTest = Test::all()->last();
        $this->assertDatabaseHas('test_versions',[
            'id' => $oldTest->version->id,
            'test_id' => $oldTest->id,
        ]);

        $newData = makeTestData();
        $this->post("/new/{$oldTest->id}", $newData)
            ->assertStatus(200);

        $newTest = Test::all()->last();

        $this->assertNotEquals($oldTest->title, $newTest->title);

//        $this->assertNotEquals($oldTest->version->id, $newTest->version->id);
        $versionsCount = TestVersion::where('test_id',1)->latest();
        $versions = $newTest->fresh();
        dd($newTest->toArray());
    }
}
