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
    public function getTagByName($tagName)
    {
        return Tag::where('name', $tagName);
    }
    public function deleteTag($tagId)
    {
        Tag::find($tagId)->delete();
    }
    public function updateTag($tagId, array $newDetails)
    {
        return tap(Tag::find($tagId))->update($newDetails);
    }
    public function createTag(array $newDetails)
    {
        return Tag::create($newDetails);
    }
}
