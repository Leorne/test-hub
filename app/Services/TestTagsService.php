<?php

namespace App\Services;

use App\Repositories\TestTagsRepository;

class TestTagsService
{
    /**
     * @var TestTagsRepository
     */
    protected $tagRepository;

    /**
     * TestTagsService constructor.
     * @param TestTagsRepository $tagRepository
     */
    public function __construct(TestTagsRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param array $tags
     * @return array
     */
    public function create(array $tags): array
    {
        $tagsIds = [];
        foreach ($tags as $tag) {
            $tagsIds[] = $this->tagRepository->create($tag)
                ->id;
        }
        return $tagsIds;
    }
}
