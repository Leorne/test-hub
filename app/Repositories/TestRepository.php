<?php

namespace App\Repositories;

use App\Http\Requests\Api\Test\TestCreateRequest;
use App\Models\Test;

class TestRepository
{
    /**
     * @var Test
     */
    protected $test;

    /**
     * TestRepository constructor.
     * @param Test $test
     */
    public function __construct(Test $test)
    {
        $this->test = $test;
    }

    /**
     * @param TestCreateRequest $request
     * @return mixed
     */
    public function create(TestCreateRequest $request)
    {
        return $this->test::create([
            'title' => $request->title,
            'about' => $request->about,
            'timer' => $request->timer,
            'full_result' => $request->full_result,
        ]);
    }
}
