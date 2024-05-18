<?php

namespace Modules\Admin\Livewire\Admin\Layouts;

use App\Models\SpecialSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserMenu extends Component
{
    public $speacial_data;
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
        $this->speacial_data=SpecialSetting::find(1);
        return view('admin::livewire.admin.layouts.user-menu');
    }
}
