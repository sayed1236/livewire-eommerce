<?php

namespace Modules\Admin\Livewire\Admin\Layouts;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use App\Models\StaticPage;
use App\Models\Admin\User;
use App\Models\SpecialSetting;
use Illuminate\Support\Facades\Auth;
class Sidebar extends Component
{
    public function render()
    {
		$select=Auth::user()->user_lang=='ar'? array("id","name_ar as name", "parent_id","page_url","img"):array("id","name", "parent_id","page_url","img");
        $user_id=Auth::id();
        $user=User::with('permissions','roles')->find($user_id);
        $pages_p=$user->getPermissionsViaRoles();
        // $pages_s= Permission::select($select)->where(['type'=>'page','parent_id'=>$record_p->id,'is_active'=>'Y'])->orderByRaw('ord ASC')->get();
        $pages_static=StaticPage::where('is_active',1)->get();
        $special_data=SpecialSetting::find(1);
        return view('admin::livewire.admin.layouts.sidebar',compact('user_id','user','pages_p','select','pages_static','special_data'));
    }
}
