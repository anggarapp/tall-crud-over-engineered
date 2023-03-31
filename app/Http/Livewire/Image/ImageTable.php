<?php

namespace App\Http\Livewire\Image;

use App\Services\ImageService;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class ImageTable extends Component
{
    use WithPagination;

    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $searchTerm;
    protected $listeners = ['refreshImageParent' => '$refresh'];

    public function render()
    {
        return view('livewire.image.image-table', [
            'images' => $this->getImages(),
            'headers' => $this->headerTable(),
        ]);
    }

    private function headerTable()
    {
        return [
            'id' => 'Id',
            'name' => 'Name',
            'url' => [
                'label' => 'Image',
                'parse' => function ($value) {
                    if ($value) {
                        return '<img src="' . url('storage/images/' . $value) . '" width="100px">';
                    } else {
                        return 'No Image';
                    }
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

    public function getImages()
    {
        $imageService = App::make(ImageService::class);
        try {
            $images = $imageService->findImageWithSort($this->sortColumn, $this->sortDirection, $this->searchTerm)->paginate(5);
            return $images;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
