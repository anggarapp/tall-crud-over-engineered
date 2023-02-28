<?php

namespace App\Services\Impl;

use App\Repositories\PostRepository;
use App\Services\PostService;

class PostServiceImpl implements PostService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
    }
    public function getPostById($postId)
    {
    }
    public function deletePost($postId)
    {
    }
    public function updatePost($postId, array $newDetails)
    {
    }
    public function createPost(array $newDetails)
    {
    }
}
