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

class Create extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $mobile;
    public $profile_photo_path;
    public $role_id;
    public $member_plan;
    public $password;
    public $password_confirmation;
    public function render()
    {
        $roles_found=Jetstream::$roles;
        $roles = Role::all();

        return view('livewire.admin.users.create',compact('roles_found','roles'))->extends('admin.layout.app');
    }
    public function store()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            'email' => 'required|string|email|max:191|unique:users',
            'mobile' => 'required|string|max:25|unique:users',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|between:8,30',
            'password_confirmation' => 'required|same:password',
        ]);

        $data['name']=$this->name;
        $data['email']=$this->email;
        $data['mobile']=$this->mobile;
        $data['password']=Hash::make($this->password);
        $data['role_id']=(int)$this->role_id;
        $data['member_plan']=$this->member_plan;

        $object_added=User::create($data);
        //create user team
        $data_team=new Team();
        $data_team->user_id=$object_added->id;
        $data_team->name=$object_added->name."'s Team";
        $data_team->personal_team=1;
        $new_team=$data_team->save();
        //add user role
        $data_role=new TeamUser();
        $data_role->user_id=$object_added->id;
        $data_role->team_id=$data_team->id;
        $data_role->role=$this->member_plan;
        $data_role->save();
        // to set user current team and put image
        $data_user=User::find($object_added->id);
        $data_user->current_team_id=$data_team->id;
        if($profile_photo_path = $this->profile_photo_path)
        {
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$profile_photo_path->getClientOriginalExtension();
            $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($profile_photo_path->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(768,1024);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($profile_photo_path->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            $data_user['profile_photo_path'] = $file_name;

        }
        $data_user->save();
        //
        $this->reset_inputs();
        $this->emit('objectAdded',$object_added);
        // session()->flush('success_message','successfully added');
        // return redirect()->to(config('app.url_admin').'category');

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
