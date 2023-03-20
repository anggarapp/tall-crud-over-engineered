<?php

namespace App\Services\Impl;

use App\Models\Tag;
use App\Repositories\TagRepository;
use App\Services\TagService;
use Illuminate\Support\Facades\DB;

class TagServiceImpl implements TagService
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->getAllTags();
    }
    public function getTagById($tagId)
    {
        return $this->tagRepository->getTagById($tagId);
    }
    public function getTagByName($tagName)
    {
        return $this->tagRepository->getTagByName($tagName);
    }
    public function deleteTag($tagId)
    {
        DB::beginTransaction();
        try {
            $this->tagRepository->deleteTag($tagId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function updateTag($tagId, array $newDetails)
    {
        DB::beginTransaction();
        try {
            $this->tagRepository->updateTag($tagId, $newDetails);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function createTag(array $newDetails)
    {
        DB::beginTransaction();
        try {
            $tag = $this->tagRepository->createTag($newDetails);
            DB::commit();
            return $tag;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
