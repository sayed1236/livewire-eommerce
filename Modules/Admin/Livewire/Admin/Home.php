<?php

namespace Modules\Admin\Livewire\Admin;

use App\Models\Admin\User;
use App\Models\ContactUs;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $title_page;
    public $admins,$members ,$members_under_register,$members_change_type, $technision,$workshops,$users_active,$users_connect,$users_not_connect,$roles,$open_questions,$close_questions,$users_cars,$fanni_cars,$inbox_messages;
    public $gt_cities_questions;
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
        $this->title_page='Home';
        $this->admins=User::where('member_plan','Hi-Admin')->count();
        $this->members=User::where(['role_id'=>1])->whereNotNull('name')->count();
        $this->members_under_register=User::where(['role_id'=>1])->whereNull('name')->count();
        $this->members_change_type=User::where('id','>',1)->where('change_user_type','>',0)->whereNotNull('name')->count();
        $this->technision=User::where(['role_id'=>2])->count();
        $this->workshops=User::where(['role_id'=>3])->count();
        $this->users_active=User::join('users_details','users.id','=','users_details.user_id')
                ->where('is_open_notifications','Y')
                ->whereIN('role_id',[2,3])->count();
        $this->users_connect=User::select('id')->where('is_connect','Y')
                ->whereIN('role_id',[2,3])->count();
        $this->users_not_connect=User::select('id')->where('is_connect','N')
                ->whereIN('role_id',[2,3])->count();
        $this->roles=Role::count();
        // $this->open_questions=Question::where(['status'=>'open'])->count();
        // $this->close_questions=Question::where(['status'=>'close'])->count();
        // $this->gt_cities_questions=Question::select(DB::raw('COUNT(*) as city_count'),'city_id')->with('city')->where(['status'=>'close'])->groupBy('city_id')->get();
        // //dd($this->gt_cities_questions);
        // $this->users_cars=UsersCar::where('type',0)->count();
        // $this->fanni_cars=UsersCar::where('type',1)->count();
        $this->inbox_messages=ContactUs::count();
        return view('admin::livewire.admin.home')->extends('admin::admin.layouts.app');
    }
}
