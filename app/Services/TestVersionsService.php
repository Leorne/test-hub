<?php

namespace App\Services;

use App\Models\TestVersion;
use App\Repositories\TestVersionsRepository;

class TestVersionsService
{
    /**
     * @var TestVersionsRepository
     */
    protected $versionRepository;

    /**
     * TestVersionsRepository constructor.
     * @param TestVersionsRepository $versionRepository
     */
    public function __construct(TestVersionsRepository $versionRepository)
    {
        $this->versionRepository = $versionRepository;
    }

    /**
     * @param int $testId
     * @return TestVersion
     */
    public function create(int $testId) : TestVersion
    {
        return $this->versionRepository->create($testId);

    }
}
