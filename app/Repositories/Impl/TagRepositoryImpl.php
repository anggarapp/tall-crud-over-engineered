<?php

namespace App\Repositories\Impl;

use App\Models\Tag;
use App\Repositories\TagRepository;

class TagRepositoryImpl implements TagRepository
{
    public function getAllTags()
    {
        return Tag::all();
    }
    public function getTagById($tagId)
    {
        return Tag::find($tagId);
    }
    public function deleteTag($tagId)
    {
        Tag::find($tagId)->delete();
    }
    public function updateTag($tagId, array $newDetails)
    {
        Tag::find($tagId)->update($newDetails);
    }
    public function createTag(array $newDetails)
    {
        Tag::create($newDetails);
    }
}
