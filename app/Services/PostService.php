<?php

namespace App\Services;

interface PostService
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function updatePost($postId, array $newDetails);
    public function updatePostNewImages($postId, $newImages);
    public function createPost(array $newDetails);
    public function findPostWithSort($sortColumn, $sortDirection, $searchTerm = null);
}
