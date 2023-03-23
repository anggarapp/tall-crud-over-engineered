<?php

namespace App\Http\Livewire\Tag;

use App\Http\Livewire\ModalBase;
use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TagDeleteModal extends ModalBase
{

    public $selectedTagId;

    public function getListeners()
    {
        return $this->listeners + [
            'showDelete' => 'showDelete'
        ];
    }

    public function render()
    {
        return view('livewire.tag.tag-delete-modal');
    }

    public function showDelete($selectedTagId)
    {
        $this->selectedTagId = $selectedTagId;
        $this->show();
    }

    public function delete()
    {
        $tagService = App::make(TagService::class);
        $tagService->deleteTag($this->selectedTagId);
        $this->emit('refreshTagParent');
        $this->unshow();
    }
}
