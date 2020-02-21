<?php

use App\Models\QuestionAnswer;
use App\Models\TestTag;
use App\Models\TestVersion;
use Illuminate\Database\Seeder;

use App\Models\Test;
use App\Models\Tag;
use App\Models\Question;
use App\Models\Answers\ChooseAnswer;
use App\Models\Answers\InputString;
use App\Models\Answers\InputNumber;

class TestSeeder extends Seeder
{
    private $answerTypes = [
        ChooseAnswer::class,
        InputNumber::class,
        InputString::class
    ];

    private $answersCount = [
        ChooseAnswer::class => '5',
        InputString::class => '3',
        InputNumber::class => '1'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = factory(Test::class)->create();
        $tags = factory(Tag::class, 3)->create();
        $testVersion = TestVersion::create([
            'test_id' => $test->id
        ]);
        foreach ($tags as $tag) {
            TestTag::create([
                'test_id' => $test->id,
                'tag_id' => $tag->id,
            ]);
        }

        $countQuestions = 5;
        for ($i = 0; $i < $countQuestions; $i++) {
            $question = $this->createQuestion($testVersion);
            $this->createAnswers($this->answerTypes[array_rand($this->answerTypes)], $question);
        }
    }


    public function createQuestion(TestVersion $testVersion): Question
    {
        return factory(Question::class)->create(['test_version_id' => $testVersion->id]);
    }

    public function createAnswers($answerClass, Question $question): array
    {
        foreach (range(1, $this->answersCount[$answerClass]) as $i) {
            $answers[] = factory($answerClass)->create();
        }
        foreach ($answers as $answer) {
            QuestionAnswer::create([
                'question_id' => $question->id,
                'answer_id' => $answer->id,
                'answer_type' => get_class($answer)
            ]);
        }
        return $answers;
    }
}
