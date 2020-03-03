<?php


namespace App\Repositories\Answers;


use App\Models\Answers\ChooseAnswer;

class ChooseAnswerRepository
{
    /**
     * @var ChooseAnswer
     */
    protected $answer;

    /**
     * ChooseAnswerRepository constructor.
     * @param ChooseAnswer $answer
     */
    public function __construct(ChooseAnswer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param array $answer
     * @return ChooseAnswer
     */
    public function create(array $answer): ChooseAnswer
    {
        return $this->answer->create([
            'answer' => $answer['answer'],
            'next_question_id' => isset($answer['next_question_id']) ? $answer['next_question_id'] : null,
            'correct' => $answer['correct'],
        ]);
    }
}
