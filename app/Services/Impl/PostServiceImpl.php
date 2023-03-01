<?php

namespace App\Services\Impl;

use App\Repositories\PostRepository;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;

class PostServiceImpl implements PostService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }
    public function getPostById($postId)
    {
        return $this->postRepository->getPostById($postId);
    }
    public function deletePost($postId)
    {
        DB::beginTransaction();
        try {
            $this->postRepository->deletePost($postId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function updatePost($postId, array $newDetails)
    {
        DB::beginTransaction();
        try {
            $this->postRepository->updatePost($postId, $newDetails);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function createPost(array $newDetails)
    {
        DB::beginTransaction();
        try {
            $this->postRepository->createPost($newDetails);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
