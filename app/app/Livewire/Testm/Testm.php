<?php

namespace App\Livewire\Testm;

use Livewire\Component;

class Testm extends Component
{
    public $title_page,$type,$parent_id,$showForm,$btn_kwrd;
    function eventt_p() {
        $this->showForm=!$this->showForm;
        if($this->showForm == true)
        {
            $this->title_page=__('ms_lang.btn_add_new');
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page=__('ms_lang.view');
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
        $this->dispatch('open-eventm',numb:123);


    }
    public function mount()
    {
        $this->showForm=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {
        return view('livewire.testm.testm');
    }
}
