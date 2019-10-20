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
        $n = 10;
        for ($i = 0; $i < $n; $i++) {
            $test = factory('App\Test')->create();
            $tags = factory('App\Tag', 3)->create();
            foreach ($tags as $tag) {
                TestTag::create([
                    'test_id' => $test->id,
                    'tag_id' => $tag->id,
                ]);
            }

            $types = ['one_answer', 'many_answers', 'input_number', 'input_string'];
            for ($i = 0; $i < $n; $i++) {
                $questionType = $types[array_rand($types)];
                $question = factory('App\Question')->create([
                    'test_id' => $test->id,
                    'question_type' => $questionType
                ]);
                if ($questionType === 'one_answer') {

                    factory('App\Answer', 'one_answer', 3)->create(['question_id' => $question->id]);
                    factory('App\Answer', 'one_answer.correct', 1)->create(['question_id' => $question->id]);

                } elseif ($questionType === 'many_answers') {

                    factory('App\Answer', 'many_answers', 2)->create(['question_id' => $question->id]);
                    factory('App\Answer', 'many_answers.correct', 2)->create(['question_id' => $question->id]);

                } else {

                    factory('App\Answer', $questionType)->create(['question_id' => $question->id]);

                }
            }
        }
    }
}
