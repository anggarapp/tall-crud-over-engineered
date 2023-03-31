<?php

namespace App\Http\Livewire\Image;

use App\Http\Livewire\ModalBase;
use App\Services\ImageService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ImageDeleteModal extends ModalBase
{
    public $selectedImageId;

    public function getListeners()
    {
        return $this->listeners + [
            'showDelete' => 'showDelete'
        ];
    }

    public function render()
    {
        return view('livewire.image.image-delete-modal');
    }

    public function showDelete($selectedImageId)
    {
        $this->selectedImageId = $selectedImageId;
        $this->show();
    }

    public function delete()
    {
        $imageService = App::make(ImageService::class);
        $imageService->deleteImage($this->selectedImageId);
        $this->emit('refreshImageParent');
        $this->unshow();
    }
}
