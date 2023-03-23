<?php

namespace App\Services;

interface TagService
{
    public function getAllTags();
    public function getTagById($tagId);
    public function getTagByName($tagName);
    public function deleteTag($tagId);
    public function updateTag($tagId, array $newDetails);
    public function createTag(array $newDetails);
    public function findTagWithSort($sortColumn, $sortDirection, $searchTerm = null);
}
