<?php

namespace App\Services\Impl;

use App\Repositories\ImageRepository;
use App\Services\ImageService;

class ImageServiceImpl implements ImageService
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getAllImages()
    {
    }
    public function getImageById($imageId)
    {
    }
    public function deleteImage($imageId)
    {
    }
    public function updateImage($imageId, array $newDetails)
    {
    }
    public function createImage(array $newDetails)
    {
    }
}
