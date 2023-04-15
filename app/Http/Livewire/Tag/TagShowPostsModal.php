<?php

namespace App\Http\Livewire\Tag;

use App\Http\Livewire\ModalBase;
use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class TagShowPostsModal extends ModalBase
{
    public $selectedTagId;

    public function getListeners()
    {
        return $this->listeners + [
            'showPosts' => 'showPosts'
        ];
    }

    private function headerTable()
    {
        return [
            'id' => 'Id',
            'title' => 'Title',
            'content' => [
                'label' => 'content',
                'parse' => function ($value) {
                    return substr($value, 0, 30) . ' ...';
                }
            ],
            'created_at' => [
                'label' => 'Created',
                'parse' => function ($value) {
                    return $value->diffForHumans();
                }
            ],
        ];
    }

    public function showPosts($selectedTagId)
    {
        $this->selectedTagId = $selectedTagId;
        $this->show();
    }

    private function getPosts()
    {
        if (!$this->selectedTagId) {
            return [];
        }

        $tagService = App::make(TagService::class);
        $tag = $tagService->getTagById($this->selectedTagId);
        $posts_related_tag = $tag->posts;
        // dd($posts_related_tag);
        return $posts_related_tag;
    }

    public function render()
    {
        return view('livewire.tag.tag-show-posts-modal', [
            'posts' => $this->getPosts(),
            'headers' => $this->headerTable(),
        ]);
    }
}
