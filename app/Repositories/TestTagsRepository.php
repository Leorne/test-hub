<?php

namespace App\Repositories;

use App\Models\Tag;

class TestTagsRepository
{
    /**
     * @var Tag
     */
    protected $tag;

    /**
     * TestTagsRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @param string $tagName
     * @return Tag
     */
    public function create(string $tagName) : Tag
    {
        return $this->tag->create([
            'value' => $tagName
        ]);
    }
}
