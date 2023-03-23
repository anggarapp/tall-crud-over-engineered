<?php

namespace App\Http\Livewire\Tag;

use App\Http\Livewire\ModalBase;
use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TagUpdateModal extends ModalBase
{
    public $selectedTagId;
    public $name;
    public $rules = [
        'name' => 'required|min:3',
    ];


    public function getListeners()
    {
        return $this->listeners + [
            'showUpdate' => 'showUpdate'
        ];
    }

    public function render()
    {
        return view('livewire.tag.tag-update-modal');
    }

    public function clearVariable()
    {
        $this->name = null;
        $this->selectedTagId = null;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshTagParent');
    }

    public function showUpdate($selectedTagId)
    {
        $this->selectedTagId = $selectedTagId;
        $tagService = App::make(TagService::class);
        $selectedTag = $tagService->getTagById($this->selectedTagId);
        $this->name = $selectedTag->name;
        $this->show();
    }

    public function storeUpdate()
    {
        $this->validate();
        $tagService = App::make(TagService::class);
        $updatedTag = $tagService->updateTag($this->selectedTagId, [
            'name' => $this->name,
        ]);
        if ($updatedTag) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
