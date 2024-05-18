<?php

namespace Modules\Admin\Livewire\Admin\Users;

use App\Models\Admin\User;
use App\Models\Role;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Jetstream\Jetstream;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $profile_photo_path;
    public $role_id;
    public $member_plan;
    public $password,$user_id;
    public $password_confirmation;
    public function mount()
    {
        $this->user_id=auth()->id();
        if( $this->user_id != null){
            $data_user=User::find($this->user_id);
            $this->name=$data_user->name;
            $this->email=$data_user->email;
        }
    }
    public function render()
    {
        $roles_found=Jetstream::$roles;
        $roles = Role::all();
        return view('livewire.admin.users.update-profile',compact('roles_found','roles'))->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function store()
    {
        $this->validate([
            'email' => 'required|string|email|max:191|unique:users,email,'.$this->user_id,
        ]);
        $data_user=User::find($this->user_id);
        $data_user->email=$this->email;
        $data_user->password=Hash::make($this->password);
        $data_user->save();
        //
        // session()->flush('success_message','successfully update');
        $this->reset_inputs();
        // $this->emit('objectAdded');
        // session()->flush('success_message','successfully added');
        return redirect()->to('login');

    }

    public function reset_inputs()
    {
        $this->ord= null;
        $this->type= null;
        $this->parent_id= null;
        $this->name= null;
        $this->name_en= null;
        $this->details= null;
        $this->details_en= null;
    }
}
