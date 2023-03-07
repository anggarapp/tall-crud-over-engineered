<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;

    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $searchTerm;

    public function render()
    {
        return view('livewire.post.post-table', [
            'posts' => $this->getPosts(),
            'headers' => $this->headerTable(),
        ]);
    }

    public function getPosts()
    {
        $postService = App::make(PostService::class);
        try {
            $posts = $postService->findPostWithSort($this->sortColumn, $this->sortDirection, $this->searchTerm)->paginate(5);
            // $posts = Post::select('id', 'title', 'content', 'created_at')
            //     ->where(function ($query) {
            //         if ($this->searchTerm) {
            //             $query->where('title', 'like', '%' . $this->searchTerm . '%');
            //             $query->orWhere('content', 'like', '%' . $this->searchTerm . '%');
            //         }
            //     })
            //     ->orderBy($this->sortColumn, $this->sortDirection)->paginate(5);
            // dd($posts);
            return $posts;
        } catch (\Throwable $th) {
            return [];
        }
    }

    private function headerTable()
    {
        return [
            'id' => 'Id',
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => [
                'label' => 'Created',
                'parse' => function ($value) {
                    return $value->diffForHumans();
                }
            ],
        ];
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }
}
