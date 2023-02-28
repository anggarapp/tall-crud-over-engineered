<?php

namespace App\Repositories;

interface TagRepository
{
    public function getAllTags();
    public function getTagById($tagId);
    public function deleteTag($tagId);
    public function updateTag($tagId, array $newDetails);
    public function createTag(array $newDetails);
}
