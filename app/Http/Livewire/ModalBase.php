<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalBase extends Component
{
    public $show = false;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show()
    {
        $this->show = true;
    }

    public function unshow()
    {
        $this->show = false;
    }
}
