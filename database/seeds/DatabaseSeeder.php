<?php

use App\TestTag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $n = 20;
        for ($i = 0; $i<$n; $i++){
            $test = factory('App\Test')->create();
            $tags = factory('App\Tag', 3)->create();

            foreach ($tags as $tag){
                TestTag::create([
                    'test_id' => $test->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }
    }
}
