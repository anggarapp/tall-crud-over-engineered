<?php

namespace App\Http\Livewire\Image;

use App\Http\Livewire\ModalBase;
use App\Services\ImageService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpdateModal extends ModalBase
{
    use WithFileUploads;

    public $selectedImageId;
    public $name;
    public $image;
    public $oldImage;
    public $tags = [];
    public $clearId;

    public $rules = [
        'name' => 'required|min:3',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
    ];

    public function getListeners()
    {
        return $this->listeners + [
            'showUpdate' => 'showUpdate'
        ];
    }

    public function render()
    {
        return view('livewire.image.image-update-modal');
    }

    public function clearVariable()
    {
        $this->resetExcept('clearId');
        $this->clearId++;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function showUpdate($selectedImageId)
    {
        $this->selectedImageId = $selectedImageId;
        $imageService = App::make(ImageService::class);
        $selectedImage = $imageService->getImageById($this->selectedImageId);
        $this->name = $selectedImage->name;
        // $this->image = $selectedImage->url;
        $this->oldImage = $selectedImage->url;
        $this->tags = $selectedImage->tags->pluck('name')->toArray();
        $this->show();
    }

    public function storeUpdate()
    {
        $this->validate();
        $imageService = App::make(ImageService::class);
        $updatedImage = $imageService->updateImage($this->selectedImageId, [
            'name' => $this->name,
            'image' => $this->image,
            'oldImage' => $this->oldImage,
            'tags' => $this->tags,
        ]);
        if ($updatedImage) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshImageParent');
    }
}
