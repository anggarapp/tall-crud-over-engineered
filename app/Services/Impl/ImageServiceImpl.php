<?php

namespace App\Services\Impl;

use App\Repositories\ImageRepository;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class ImageServiceImpl implements ImageService
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
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
        DB::beginTransaction();
        try {
            $this->imageRepository->deleteImage($imageId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function updateImage($imageId, array $newDetails)
    {
        DB::beginTransaction();
        try {
            $this->imageRepository->updateImage($imageId, $newDetails);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function createImage(array $newDetails)
    {
        DB::beginTransaction();
        try {
            $this->imageRepository->createImage($newDetails);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
