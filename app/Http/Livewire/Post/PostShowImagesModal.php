<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use App\Services\PostService;
use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;

class PostShowImagesModal extends ModalBase
{
    use WithFileUploads;
    public $selectedPostId;
    public $clearId;
    public $new_images = [];
    public $rules = [];
    public function getListeners()
    {
        return $this->listeners + [
            'showImages' => 'showImages',
            'addNewImages' => 'addNewImages',
        ];
    }

    public function render()
    {
        return view('livewire.post.post-show-images-modal', [
            'images' => $this->getImages()
        ]);
    }

    public function showImages($selectedPostId)
    {
        $this->selectedPostId = $selectedPostId;
        $this->show();
    }

    private function getImages()
    {
        if (!$this->selectedPostId) {
            return [];
        }

        $postService = App::make(PostService::class);
        $post = $postService->getPostById($this->selectedPostId);
        $images_related_post = $post->images;
        // dd($images_related_post);
        return $images_related_post;
    }

    public function addNewImages()
    {
        if (!$this->selectedPostId) {
            return null;
        }
        if (!$this->new_images) {
            return null;
        }
        if (!empty($this->new_images)) {
            $this->rules = array_merge($this->rules, [
                'new_images.*' => 'image|mimes:jpg,png,jpeg,gif,svg'
            ]);
        }

        $this->validate();
        $postService = App::make(PostService::class);
        $updatedPost = $postService->updatePostNewImages($this->selectedPostId, $this->new_images);
        if ($updatedPost) {
            $this->unshow();
        } else {
            dd('error');
        }
    }
}
