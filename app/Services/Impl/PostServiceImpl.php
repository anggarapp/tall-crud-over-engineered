<?php

namespace App\Services\Impl;

use App\Models\Tag;
use App\Repositories\PostRepository;
use App\Services\ImageService;
use App\Services\PostService;
use App\Services\TagService;
use Error;
use Illuminate\Support\Facades\DB;

class PostServiceImpl implements PostService
{
    private PostRepository $postRepository;
    private TagService $tagService;
    private ImageService $imageService;

    public function __construct(PostRepository $postRepository, TagService $tagService, ImageService $imageService)
    {
        $this->postRepository = $postRepository;
        $this->tagService = $tagService;
        $this->imageService = $imageService;
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
            $updatedPost = $this->postRepository->updatePost($postId, [
                'title' => $newDetails['title'],
                'content' => $newDetails['content']
            ]);
            if ($newDetails['tags']) {
                $tag_array = array();
                foreach ($newDetails['tags'] as $tag) {
                    // $item = Tag::where('name', $tag)->first();
                    $item = $this->tagService->getTagByName($tag)->first();
                    if (!$item) {
                        $newTag = $this->tagService->createTag([
                            'name' => $tag,
                        ]);
                        array_push($tag_array, $newTag->id);
                    } else {
                        array_push($tag_array, $item->id);
                    }
                }

                $updatedPost->tags()->sync($tag_array);
            }
            DB::commit();
            return $updatedPost;
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e);
        }
    }
    public function createPost(array $newDetails)
    {
        DB::beginTransaction();
        try {
            $createdPost = $this->postRepository->createPost($newDetails);
            if ($newDetails['tags']) {
                $tag_array = array();
                foreach ($newDetails['tags'] as $tag) {
                    $item = $this->tagService->getTagByName($tag)->first();
                    if (!$item) {
                        $newTag = $this->tagService->createTag([
                            'name' => $tag,
                        ]);
                        array_push($tag_array, $newTag->id);
                    } else {
                        array_push($tag_array, $item->id);
                    }
                }
                $createdPost->tags()->sync($tag_array);
            }
            // test();
            DB::commit();
            return $createdPost;
        } catch (Error $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function findPostWithSort($sortColumn, $sortDirection = 'asc', $searchTerm = null)
    {
        return $this->postRepository->findPostWithSort($sortColumn, $sortDirection, $searchTerm);
    }
}
