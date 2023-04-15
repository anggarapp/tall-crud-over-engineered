<?php

namespace App\Http\Livewire\Image;

use App\Http\Livewire\ModalBase;
use App\Services\ImageService;
use Illuminate\Support\Facades\App;

class ImageShowPostsModal extends ModalBase
{

    public $selectedImageId;

    public function getListeners()
    {
        return $this->listeners + [
            'showPosts' => 'showPosts'
        ];
    }

    private function headerTable()
    {
        return [
            'id' => 'Id',
            'title' => 'Title',
            'content' => [
                'label' => 'content',
                'parse' => function ($value) {
                    return substr($value, 0, 30) . ' ...';
                }
            ],
            'created_at' => [
                'label' => 'Created',
                'parse' => function ($value) {
                    return $value->diffForHumans();
                }
            ],
        ];
    }

    public function showPosts($selectedImageId)
    {
        $this->selectedImageId = $selectedImageId;
        $this->show();
    }

    private function getPosts()
    {
        if (!$this->selectedImageId) {
            return [];
        }

        $imageService = App::make(ImageService::class);
        $image = $imageService->getImageById($this->selectedImageId);
        $posts_related_image = $image->posts;
        // dd($posts_related_image);
        return $posts_related_image;
    }


    public function render()
    {
        return view('livewire.image.image-show-posts-modal', [
            'posts' => $this->getPosts(),
            'headers' => $this->headerTable(),
        ]);
    }
}
