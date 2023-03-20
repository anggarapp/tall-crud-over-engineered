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
        return tap(Post::find($postId))->update($newDetails);
    }
    public function createPost(array $newDetails)
    {
        return Post::create($newDetails);
    }
    public function findPostWithSort($sortColumn, $sortDirection = 'asc', $searchTerm = null)
    {
        return Post::select('id', 'title', 'content', 'created_at')
            ->where(function ($query) use ($searchTerm) {
                if ($searchTerm) {
                    $query->where('title', 'like', '%' . $searchTerm . '%');
                    $query->orWhere('content', 'like', '%' . $searchTerm . '%');
                }
            })
            ->orderBy($sortColumn, $sortDirection);
    }
}
