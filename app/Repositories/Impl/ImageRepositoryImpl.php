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
        return tap(Image::find($imageId))->update($newDetails);
    }
    public function createImage(array $newDetails)
    {
        return Image::create($newDetails);
    }
    public function findImageWithSort($sortColumn, $sortDirection = 'asc', $searchTerm = null)
    {
        return Image::select('id', 'name', 'url', 'created_at')
            ->where(function ($query) use ($searchTerm) {
                if ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                    $query->orWhere('url', 'like', '%' . $searchTerm . '%');
                }
            })
            ->orderBy($sortColumn, $sortDirection);
    }
}
