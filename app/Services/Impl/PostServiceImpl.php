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
        $post = $this->getPostById($postId);
        DB::beginTransaction();
        try {
            $post->tags()->sync([]);
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
            if (isset($newDetails['tags'])) {
                $tag_id_array = array();
                foreach ($newDetails['tags'] as $tag) {
                    // $item = Tag::where('name', $tag)->first();
                    $item = $this->tagService->getTagByName($tag)->first();
                    if (!$item) {
                        $newTag = $this->tagService->createTag([
                            'name' => $tag,
                        ]);
                        array_push($tag_id_array, $newTag->id);
                    } else {
                        array_push($tag_id_array, $item->id);
                    }
                }

                $updatedPost->tags()->sync($tag_id_array);
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

            if (isset($newDetails['tags'])) {
                $tag_id_array = array();
                foreach ($newDetails['tags'] as $tag) {
                    $item = $this->tagService->getTagByName($tag)->first();
                    if (!$item) {
                        $newTag = $this->tagService->createTag([
                            'name' => $tag,
                        ]);
                        array_push($tag_id_array, $newTag->id);
                    } else {
                        array_push($tag_id_array, $item->id);
                    }
                }
                $createdPost->tags()->sync($tag_id_array);
            }

            if (isset($newDetails['images'])) {
                $image_id_array = array();
                foreach ($newDetails['images'] as $image) {
                    $createdImage = $this->imageService->createImage([
                        'name' => str_replace('.' . $image->extension(), "", $image->getClientOriginalName()),
                        'image' => $image,
                        'tags' => $newDetails['tags'] ?? [],
                    ]);
                    array_push($image_id_array, $createdImage->id);
                }
                $createdPost->images()->sync($image_id_array);
            }
            // test();
            DB::commit();
            return $createdPost;
        } catch (Error $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function updatePostNewImages($postId, $newImages)
    {
        DB::beginTransaction();
        try {
            $post = $this->getPostById($postId);
            $postTags = $post->tags()->select('name')->get()->pluck('name')->toArray();
            // dd($postTags);
            $image_id_array = array();
            foreach ($newImages as $image) {
                $createdImage = $this->imageService->createImage([
                    'name' => str_replace('.' . $image->extension(), "", $image->getClientOriginalName()),
                    'image' => $image,
                    'tags' => $postTags ?? [],
                ]);
                array_push($image_id_array, $createdImage->id);
            }
            $post->images()->attach($image_id_array);
            DB::commit();
            return true;
        } catch (Error $e) {
            return false;
        }
    }

    public function findPostWithSort($sortColumn, $sortDirection = 'asc', $searchTerm = null)
    {
        return $this->postRepository->findPostWithSort($sortColumn, $sortDirection, $searchTerm);
    }
}
