<?php

namespace Modules\Admin\Livewire\Admin\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderMenu extends Component
{
    public $data_kt_menu_placement_bottom,$data_kt_menu_placement_start;
    public function render()
    {
        // 2 direct design in rtl or ltr
        if(Auth::user()->user_lang == 'ar')
        { // rtl
            $this->data_kt_menu_placement_bottom='bottom-end';
            $this->data_kt_menu_placement_start='left-start';
        }
        else
        {
            $this->data_kt_menu_placement_bottom='bottom-start';
            $this->data_kt_menu_placement_start='right-start';
        }

        return view('admin::livewire.admin.layouts.header-menu');
    }
}
