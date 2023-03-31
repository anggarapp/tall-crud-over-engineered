<?php

namespace App\Services;

interface ImageService
{
    public function getAllImages();
    public function getImageById($imageId);
    public function deleteImage($imageId);
    public function updateImage($imageId, array $newDetails);
    public function createImage(array $newDetails);
    public function findImageWithSort($sortColumn, $sortDirection, $searchTerm = null);
}
