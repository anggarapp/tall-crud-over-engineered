<?php

namespace App\Repositories;

interface PostRepository
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function updatePost($postId, array $newDetails);
    public function createPost(array $newDetails);
    public function findPostWithSort($sortColumn, $sortDirection, $searchTerm = null);
}
