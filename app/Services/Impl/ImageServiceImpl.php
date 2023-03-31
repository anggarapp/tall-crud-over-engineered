<?php

namespace App\Services\Impl;

use App\Repositories\ImageRepository;
use App\Services\ImageService;
use App\Services\TagService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageServiceImpl implements ImageService
{
    private ImageRepository $imageRepository;
    private TagService $tagService;

    public function __construct(ImageRepository $imageRepository, TagService $tagService)
    {
        $this->tagService = $tagService;
        $this->imageRepository = $imageRepository;
    }

    public function getAllImages()
    {
        return $this->imageRepository->getAllImages();
    }
    public function getImageById($imageId)
    {
        return $this->imageRepository->getImageById($imageId);
    }
    public function deleteImage($imageId)
    {
        $image = $this->getImageById($imageId);
        $imageUrl = $image->url;
        DB::beginTransaction();
        try {
            $image->tags()->sync([]);
            $this->imageRepository->deleteImage($imageId);
            DB::commit();
            Storage::delete('public/images/' . $imageUrl);
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function updateImage($imageId, array $newDetails)
    {
        $imageHashName = null;
        //need to ad case if image changed, old image deleted on storage
        DB::beginTransaction();
        try {
            $deletedImageName = null;
            if (!isset($newDetails['name']) && !isset($newDetails['image'])) {
                throw new Exception();
            }
            $imageHashName = $newDetails['oldImage'];
            if ($newDetails['image']) {
                $imageHashName = $newDetails['image']->hashName();
                $newDetails['image']->store('public/images');
                $deletedImageName = $newDetails['oldImage'];
            }
            $updatedImage = $this->imageRepository->updateImage($imageId, [
                'name' => $newDetails['name'],
                'url' => $imageHashName,
            ]);
            if (isset($newDetails['tags'])) {
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
                $updatedImage->tags()->sync($tag_array);
            }
            if ($deletedImageName) {
                #delete image here
                // dd($deletedImageName);
                Storage::delete('public/images/' . $deletedImageName);
            }
            DB::commit();
            return $updatedImage;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function createImage(array $newDetails)
    {
        $imageHashName = null;
        DB::beginTransaction();
        try {
            if (!isset($newDetails['name']) && !isset($newDetails['image'])) {
                throw new Exception();
            }
            $imageHashName = $newDetails['image']->hashName();
            $newDetails['image']->store('public/images');
            $createdImage = $this->imageRepository->createImage([
                'name' => $newDetails['name'],
                'url' => $imageHashName,
            ]);
            if (isset($newDetails['tags'])) {
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
                $createdImage->tags()->sync($tag_array);
            }
            DB::commit();
            return $createdImage;
        } catch (\Exception $e) {
            //need remove saved image file on storage logic
            DB::rollBack();
        }
    }

    public function findImageWithSort($sortColumn, $sortDirection = 'asc', $searchTerm = null)
    {
        return $this->imageRepository->findImageWithSort($sortColumn, $sortDirection, $searchTerm);
    }
}
