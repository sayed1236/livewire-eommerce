<?php

namespace App\Livewire\Testm;

use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Edit extends Component
{
    public $showForm,$title_page,$btn_kwrd;
    #[Reactive]
    public $numbe;
    #[On('open-eventm')]
    function printNum($numbe) {

        $this->numbe=$numbe;
    }

    public function mount($numb=0)
    {
        $this->numb=$numb;
        $this->showForm=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {
        return view('livewire.testm.edit');
    }
}
