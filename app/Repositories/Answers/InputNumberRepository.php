<?php


namespace App\Repositories\Answers;


use App\Models\Answers\InputNumber;

class InputNumberRepository
{
    /**
     * @var InputNumber
     */
    protected $answer;

    /**
     * InputNumberRepository constructor.
     * @param InputNumber $answer
     */
    public function __construct(InputNumber $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param array $answer
     * @return InputNumber
     */
    public function create(array $answer) : InputNumber
    {
        return $this->answer->create([
            'answer' => $answer['answer'],
            'error_range' => $answer['error_range'],
            'next_question_id' => isset($answer['next_question_id']) ? $answer['next_question_id'] : null,
        ]);
    }
}
