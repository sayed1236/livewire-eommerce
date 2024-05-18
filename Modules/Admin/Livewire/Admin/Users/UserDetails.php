<?php

namespace Modules\Admin\Livewire\Admin\Users;

use App\Models\Admin\User;
use App\Models\Role;
use Livewire\Component;

class UserDetails extends Component
{
    // public $name;
    // public $email;
    // public $mobile;
    // public $profile_photo_path;
    // public $role_id;
    // public $member_plan;
    // public $password;
    // public $password_confirmation;
    // public $edit_object;
    // public $edit_id;
    // protected $listeners=[
    //     'getObject' => 'get_object'

    // ];

    // public function mount()
    // {
    //     $this->edit_object= User::with('user_detail')->where('deleted_at',null)->whereId($this->edit_id)->first();
    // }
    // public function render()
    // {
    //     return view('livewire.admin.users.user-details',[
    //         'edit_object'=>$this->edit_object,
    //     ])->extends('admin.layouts.app');
    // }
    // public function get_object($edit_object)
    // {
    //     $this->edit_object=$edit_object;
    //     $this->edit_id=$this->edit_object['id'];
    //     $this->name=$this->edit_object['name'];
    //     $this->email=$this->edit_object['email'];
    //     $this->mobile=$this->edit_object['mobile'];
    //     $this->profile_photo_path=$this->edit_object['profile_photo_path'];
    //     $this->role_id=$this->edit_object['role_id'];
    //     $this->member_plan=$this->edit_object['member_plan'];

    // }

}
