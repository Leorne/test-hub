<?php

namespace App\Repositories;

use App\Models\TestVersion;

class TestVersionsRepository
{
    /**
     * @var TestVersion
     */
    protected $version;

    /**
     * TestVersionsRepository constructor.
     * @param TestVersion $version
     */
    public function __construct(TestVersion $version)
    {
        $this->version = $version;
    }

    /**
     * @param int $testId
     * @return TestVersion
     */
    public function create(int $testId) : TestVersion
    {
        return $this->version->create([
            'test_id' => $testId
        ]);
    }
}
