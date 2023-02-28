<?php

namespace App\Services\Impl;

use App\Repositories\TagRepository;
use App\Services\TagService;

class TagServiceImpl implements TagService
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
    public function getAllTags()
    {
    }
    public function getTagById($tagId)
    {
    }
    public function deleteTag($tagId)
    {
    }
    public function updateTag($tagId, array $newDetails)
    {
    }
    public function createTag(array $newDetails)
    {
    }
}
