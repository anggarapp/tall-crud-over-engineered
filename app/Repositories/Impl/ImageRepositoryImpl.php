<?php

namespace App\Repositories\Impl;

use App\Models\Image;
use App\Repositories\ImageRepository;

class ImageRepositoryImpl implements ImageRepository
{
    public function getAllImages()
    {
        return Image::all();
    }
    public function getImageById($imageId)
    {
        return Image::find($imageId);
    }
    public function deleteImage($imageId)
    {
        Image::find($imageId)->delete();
    }
    public function updateImage($imageId, array $newDetails)
    {
        Image::find($imageId)->update($newDetails);
    }
    public function createImage(array $newDetails)
    {
        Image::create($newDetails);
    }
}
