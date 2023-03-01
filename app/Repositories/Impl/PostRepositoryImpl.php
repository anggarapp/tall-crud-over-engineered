<?php

namespace App\Repositories\Impl;

use App\Models\Post;
use App\Repositories\PostRepository;

class PostRepositoryImpl implements PostRepository
{
    public function getAllPosts()
    {
        return Post::all();
    }
    public function getPostById($postId)
    {
        return Post::find($postId);
    }
    public function deletePost($postId)
    {
        Post::find($postId)->delete();
    }
    public function updatePost($postId, array $newDetails)
    {
        Post::find($postId)->update($newDetails);
    }
    public function createPost(array $newDetails)
    {
        Post::create($newDetails);
    }
}
