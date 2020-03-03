<?php

namespace App\Repositories;

use App\Models\Question;

class TestQuestionsRepository
{
    /**
     * @var Question
     */
    protected $question;

    /**
     * TestQuestionsRepository constructor.
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function create(array $question, int $testVersionId) : Question
    {
        return $this->question->create([
            'test_version_id' => $testVersionId,
            'question_body' => $question['body'],
            'question_points' => $question['points'],
        ]);
    }
}
