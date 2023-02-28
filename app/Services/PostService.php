<?php

namespace App\Services;

interface PostService
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function updatePost($postId, array $newDetails);
    public function createPost(array $newDetails);
}
