<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use Livewire\Component;

class PostCreateModal extends ModalBase
{
    public function render()
    {
        return view('livewire.post.post-create-modal');
    }
}
