<?php

namespace App\Http\Livewire\Image;

use App\Http\Livewire\ModalBase;
use App\Services\ImageService;
use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Livewire\Component;

class ImageCreateModal extends ModalBase
{
    use WithFileUploads;

    public $name;
    public $image;
    public $tags = [];
    public $clearId; //to remove prev file 

    public $rules = [
        'name' => 'required|min:3',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
    ];

    public function clearVariable()
    {
        $this->resetExcept('clearId');
        $this->clearId++;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.image.image-create-modal');
    }

    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshImageParent');
    }

    public function store()
    {
        // $imageNameOnly = str_replace('.' . $this->image->extension(), "", $this->image->getClientOriginalName());

        $this->validate();

        $imageService = App::make(ImageService::class);
        $created_image = $imageService->createImage([
            'name' => $this->name,
            'image' => $this->image,
            'tags' => $this->tags,
        ]);
        if ($created_image) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
