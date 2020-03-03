<?php


namespace App\Repositories\Answers;


use App\Models\Answers\InputString;

class InputStringRepository
{
    /**
     * @var InputString
     */
    protected $answer;

    /**
     * InputStringRepository constructor.
     * @param InputString $answer
     */
    public function __construct(InputString $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param array $answer
     * @return InputString
     */
    public function create(array $answer) : InputString
    {
        return $this->answer->create([
            'answer' => $answer['answer'],
            'next_question_id' => isset($answer['next_question_id']) ? $answer['next_question_id'] : null,
        ]);
    }
}
