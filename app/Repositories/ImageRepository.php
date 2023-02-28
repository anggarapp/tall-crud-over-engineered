<?php

namespace App\Repositories;

interface ImageRepository
{
    public function getAllImages();
    public function getImageById($imageId);
    public function deleteImage($imageId);
    public function updateImage($imageId, array $newDetails);
    public function createImage(array $newDetails);
}
