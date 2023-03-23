<?php

namespace App\Http\Livewire\Post;

use App\Http\Livewire\ModalBase;
use App\Services\PostService;
use Illuminate\Support\Facades\App;

class PostUpdateModal extends ModalBase
{
    public $selectedPostId;
    public $title;
    public $content;
    public $tags = [];
    public $images;
    public $rules = [
        'title' => 'required|min:3',
        'content' => 'required',
        'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
    ];


    public function getListeners()
    {
        return $this->listeners + [
            'showUpdate' => 'showUpdate'
        ];
    }

    public function render()
    {
        return view('livewire.post.post-update-modal');
    }

    public function clearVariable()
    {
        $this->title = null;
        $this->content = null;
        $this->selectedPostId = null;
        $this->tags = [];
        $this->images = null;
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function unshow()
    {
        $this->show = false;
        $this->clearVariable();
        $this->emit('refreshPostParent');
    }

    public function showUpdate($selectedPostId)
    {
        $this->selectedPostId = $selectedPostId;
        $postService = App::make(PostService::class);
        $selectedPost = $postService->getPostById($this->selectedPostId);
        $this->title = $selectedPost->title;
        $this->content = $selectedPost->content;
        $this->tags = $selectedPost->tags->pluck('name')->toArray();
        $this->show();
    }

    public function storeUpdate()
    {
        $this->validate();
        $postService = App::make(PostService::class);
        $updatedPost = $postService->updatePost($this->selectedPostId, [
            'title' => $this->title,
            'content' => $this->content,
            'tags' => $this->tags,
        ]);
        if ($updatedPost) {
            $this->unshow();
        } else {
            // dd('error');
        }
    }
}
