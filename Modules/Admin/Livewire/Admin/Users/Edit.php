<?php

namespace Modules\Admin\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Role;
use App\Models\TeamUser;
use App\Models\UsersDetail;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Livewire\WithFileUploads;
class Edit extends Component
{
    use WithFileUploads;
    public $name,$email,$mobile,$profile_photo_path,$role_id,$member_plan,$whatsapp;
    public $password;
    public $password_confirmation;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'

    ];

    public function mount()
    {
        $this->edit_object= User::with('user_detail')->where('deleted_at',null)->whereId($this->edit_id)->first();
    }
    public function render()
    {
        $roles_found=Jetstream::$roles;
        $roles = Role::all();
        return view('livewire.admin.users.edit',[
            'edit_object'=>$this->edit_object,
            'roles'    => $roles,
            'roles_found'=>$roles_found
        ])->extends('admin.layouts.app');
    }

    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->name=$this->edit_object['name'];
        $this->email=$this->edit_object['email'];
        $this->mobile=$this->edit_object['mobile'];
        $this->whatsapp=@$this->edit_object['whatsapp'];
        $this->profile_photo_path=$this->edit_object['profile_photo_path'];
        $this->role_id=$this->edit_object['role_id'];
        $this->member_plan=$this->edit_object['member_plan'];

    }
    public function update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            //'email' => 'required|string|email|max:191|unique:users,email,'.$this->edit_id,
            'mobile' => 'required|string|max:25|unique:users,mobile,'.$this->edit_id,
            'password' => 'nullable|between:8,30',
            'password_confirmation' => 'nullable|same:password',
        ]);
        $data= User::with('user_detail')->find($this->edit_id);
        if($data->profile_photo_path != $this->profile_photo_path)
        {
            $img=$this->profile_photo_path;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
            $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(768,1024);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            $data['profile_photo_path'] = $file_name;

        }
        $data['name']=$this->name;
        $data['email']=$this->email;
        $data['mobile']=$this->mobile;
        if($this->password != '')
        {
            $data['password']=Hash::make($this->password);
        }
        $data['role_id']=(int)$this->role_id;
        $data['member_plan']=$this->member_plan;
        $data['whatsapp']=$this->whatsapp;
        $object_added=$data->save();
        //user_details
        // $data_user_det=UsersDetail::where('user_id',$this->edit_id)->first();
        // $data_user_det->save();
        //update user role
        // if($this->member_plan > 0)
        // {
        //     $data_role=TeamUser::where('user_id', $this->edit_id)->first();
        //     if(is_null($data_role)==1)
        //     {
        //         $data_role=new TeamUser();
        //         $data_role->user_id=$this->edit_id;
        //     }
        //     $data_role->team_id=2;
        //     $data_role->role=$this->member_plan;
        //     $data_role->save();
        // }

        $this->emit('objectEdit',$object_added);
    }
}
