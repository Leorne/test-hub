<?php

namespace App\Services;

use App\Repositories\Answers\ChooseAnswerRepository;
use App\Repositories\Answers\InputNumberRepository;
use App\Repositories\Answers\InputStringRepository;
use App\Repositories\TestQuestionsRepository;

class TestQuestionsService
{
    /**
     * @var TestQuestionsRepository
     */
    protected $questionRepository;

    protected $answerTypes = [
        'InputString' => 'inputStringRepository',
        'InputNumber' => 'inputNumberRepository',
        'ChooseAnswer' => 'chooseAnswerRepository',
    ];

    /**
     * @var InputStringRepository
     */
    protected $inputStringRepository;

    /**
     * @var InputNumberRepository
     */
    protected $inputNumberRepository;

    /**
     * @var ChooseAnswerRepository
     */
    protected $chooseAnswerRepository;

    /**
     * TestQuestionsService constructor.
     * @param TestQuestionsRepository $questionRepository
     * @param InputNumberRepository $inputNumberRepository
     * @param InputStringRepository $inputStringRepository
     * @param ChooseAnswerRepository $chooseAnswerRepository
     */
    public function __construct(TestQuestionsRepository $questionRepository,
                                InputNumberRepository $inputNumberRepository,
                                InputStringRepository $inputStringRepository,
                                ChooseAnswerRepository $chooseAnswerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->inputNumberRepository = $inputNumberRepository;
        $this->inputStringRepository = $inputStringRepository;
        $this->chooseAnswerRepository = $chooseAnswerRepository;
    }

    /**
     * @param array $questions
     * @param $testVersionId
     * @return array
     */
    public function create(array $questions, $testVersionId): array
    {
        $questionsResult = [];
        foreach ($questions as $question) {
            $questionsResult[] = $this->questionRepository->create($question, $testVersionId);
        }
        foreach ($questions as $question) {
            $answerRepository = $this->answerTypes[$question['type']];
            $answers = [];
            foreach ($question['answers'] as $answer) {
                if ($answer['next_question'] !== null) {
                    $answer['next_question_id'] = $questionsResult[$answer['next_question']]->id;
                }
                $answers[] = $this->$answerRepository->create($answer);
            }
        }
        return $questionsResult;
    }
}
