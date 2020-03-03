<?php

namespace App\Services;

use App\Http\Requests\Api\Test\TestCreateRequest;
use App\Models\Test;
use App\Repositories\TestRepository;

class TestService
{
    /**
     * @var TestRepository
     */
    protected $testRepository;

    protected $testVersionService;

    protected $tagService;

    protected $questionService;

    /**
     * TestService constructor.
     * @param TestRepository $testRepository
     * @param TestVersionsService $testVersionService
     * @param TestTagsService $tagService
     * @param TestQuestionsService $questionService
     */
    public function __construct(TestRepository $testRepository, TestVersionsService $testVersionService, TestTagsService $tagService, TestQuestionsService $questionService)
    {
        $this->testRepository = $testRepository;
        $this->testVersionService = $testVersionService;
        $this->tagService = $tagService;
        $this->questionService = $questionService;
    }

    public function create(TestCreateRequest $request): Test
    {
        return \DB::transaction(function () use ($request) {
            $test = $this->testRepository->create($request);
            $testVersion = $this->testVersionService->create($test->id);

            $tagsIds = $this->tagService->create($request->tags);
            $test->tags()->sync($tagsIds);

            $questions = $this->questionService->create($request->questions, $testVersion->id);

            return $test;
        });
    }
}
