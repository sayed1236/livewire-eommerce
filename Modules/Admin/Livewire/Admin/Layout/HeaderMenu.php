<?php

namespace Modules\Admin\Livewire\Admin\Layout;

use App\Models\SpecialSetting;
use Livewire\Component;

class HeaderMenu extends Component
{
    public function render()
    {
        $speacial_data=SpecialSetting::find(1);
        return view('admin::livewire.admin.layout.header-menu',compact('speacial_data'));
    }
}
