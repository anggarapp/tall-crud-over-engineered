<?php

namespace App\Http\Livewire\Tag;

use App\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class TagTable extends Component
{
    use WithPagination;

    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $searchTerm;
    protected $listeners = ['refreshTagParent' => '$refresh'];

    public function render()
    {
        return view('livewire.tag.tag-table', [
            'tags' => $this->getTags(),
            'headers' => $this->headerTable(),
        ]);
    }

    private function headerTable()
    {
        return [
            'id' => 'Id',
            'name' => 'Name',
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

    public function getTags()
    {
        $tagService = App::make(TagService::class);
        try {
            $tags = $tagService->findTagWithSort($this->sortColumn, $this->sortDirection, $this->searchTerm)->paginate(5);
            return $tags;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
