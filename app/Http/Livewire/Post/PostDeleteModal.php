<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use App\Services\PostService;

class PostDeleteModal extends ModalBase
{

    public $selectedPostId;

    public function getListeners()
    {
        return $this->listeners + [
            'showDelete' => 'showDelete'
        ];
    }

    public function render()
    {
        return view('livewire.post.post-delete-modal');
    }

    public function showDelete($selectedPostId)
    {
        $this->selectedPostId = $selectedPostId;
        $this->show();
    }

    public function delete()
    {
        $postService = App::make(PostService::class);
        $postService->deletePost($this->selectedPostId);
        $this->emit('refreshPostParent');
        $this->unshow();
    }
}
