<?php

namespace App\Http\Livewire\Tag;

use App\Http\Livewire\ModalBase;
use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TagShowImagesModal extends ModalBase
{
    public $selectedTagId;

    public function getListeners()
    {
        return $this->listeners + [
            'showImages' => 'showImages'
        ];
    }
    public function render()
    {
        return view('livewire.tag.tag-show-images-modal', [
            'images' => $this->getImages(),
        ]);
    }

    public function showImages($selectedTagId)
    {
        $this->selectedTagId = $selectedTagId;
        $this->show();
    }

    private function getImages()
    {
        if (!$this->selectedTagId) {
            return [];
        }

        $tagService = App::make(TagService::class);
        $tag = $tagService->getTagById($this->selectedTagId);
        $images_related_tag = $tag->images;
        // dd($images_related_tag);
        return $images_related_tag;
    }
}
