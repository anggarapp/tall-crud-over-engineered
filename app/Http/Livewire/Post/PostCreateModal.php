<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class PostCreateModal extends ModalBase
{
    public $title;
    public $content;
    public $tags = [];
    public $images;
    public $rules = [
        'title' => 'required|min:3',
        'content' => 'required',
        'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
    ];

    public function render()
    {
        return view('livewire.post.post-create-modal');
    }

    public function clearVariable()
    {
        $this->title = null;
        $this->content = null;
        $this->images = null;
        $this->tags = [];
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshPostParent');
    }

    public function store()
    {
        $this->validate();

        $postService = App::make(PostService::class);
        $created_post = $postService->createPost([
            'title' => $this->title,
            'content' => $this->content,
            'tags' => $this->tags,
        ]);
        if ($created_post) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
