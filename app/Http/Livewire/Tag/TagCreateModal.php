<?php

namespace App\Http\Livewire\Tag;

use App\Http\Livewire\ModalBase;
use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TagCreateModal extends ModalBase
{
    public $name;
    public $rules = [
        'name' => 'required|min:3',
    ];

    public function render()
    {
        return view('livewire.tag.tag-create-modal');
    }

    public function clearVariable()
    {
        $this->name = null;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshTagParent');
    }

    public function store()
    {
        $this->validate();

        $tagService = App::make(TagService::class);
        $created_tag = $tagService->createTag([
            'name' => $this->name,
        ]);
        if ($created_tag) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
