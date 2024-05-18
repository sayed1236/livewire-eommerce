<?php

namespace Modules\Admin\Livewire\Admin;

use App\Models\User;
use App\Models\UsersRequest;
use Livewire\Component;

class UsersRequests extends Component
{

    public $title_page,$vote_id,$showForm,$showDeleted,$btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($vote_id=0)
    {
        $this->vote_id=$vote_id;
       $this->title_page='Users Requests for Gold MemberShip';
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {

        $results= UsersRequest::get()->sortByDesc('id');
        return view('livewire.admin.users-requests',
                    [
                        'results'=>$results,
                    ])->extends('admin.layouts.app',['script_datatables'=>true]);
    }


    public function upgrade_member($id=0)
    {
        $data=UsersRequest::select('id','user_id','is_approved')->find($id);
        if($data->is_approved == 'N')
        {
            $data_user=User::select('id','shift_id')->find($data->user_id);
            $data_user->shift_id=1;
            $data_user->save();
            // to update recored approved
            $data->is_approved='Y';
            $data->is_viewed='Y';
            $data->save();
            session()->flash('success_message','successfully upgraded');
        }

    }

    public function delete_ms($id=0)
    {
        $data=UsersRequest::select('id','deleted_at')->find($id);
        if($data->deleted_at == null)
        {
            $data->deleted_at=now();
        }
        else
        {
            $data->deleted_at =null;
        }
        $data->save();
    }
}
