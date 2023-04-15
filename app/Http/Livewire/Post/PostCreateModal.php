<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreateModal extends ModalBase
{
    use WithFileUploads;

    public $title;
    public $content;
    public $tags = [];
    public $images;
    public $clearId;
    public $rules = [
        'title' => 'required|min:3',
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.post.post-create-modal');
    }

    public function clearVariable()
    {
        $this->resetExcept('clearId');
        $this->clearId++;
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
        if (!empty($this->images)) {
            $this->rules = array_merge($this->rules, [
                'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg'
            ]);
        }

        $this->validate();

        $postService = App::make(PostService::class);
        $created_post = $postService->createPost([
            'title' => $this->title,
            'content' => $this->content,
            'tags' => $this->tags,
            'images' => $this->images,
        ]);
        if ($created_post) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
