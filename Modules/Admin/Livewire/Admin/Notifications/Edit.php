<?php

namespace Modules\Admin\Livewire\Admin\Notifications;

use App\Models\Admin\User;
use App\Models\Notification;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;
    public $type,$with_id,$title,$title_en,$img,$img_icon,$img_type,$details,$details_en;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];

    public function mount()
    {
        $this->edit_object= Notification::where('deleted_at',null)->find($this->edit_id);
    }
    public function render()
    {
        return view('livewire.admin.notifications.edit',[
            'edit_object'=>$this->edit_object
        ])->extends('admin.layouts.app',['script_editor'=>true]);
    }

    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->type=$this->edit_object['type'];
        $this->with_id=$this->edit_object['with_id'];
        $this->title=$this->edit_object['title'];
        $this->title_en=$this->edit_object['title_en'];
        $this->img=$this->edit_object['img'];
        $this->img_icon=$this->edit_object['img'];
        $this->img_type= $this->type ==0 ? 'icon':'';
        $this->details=$this->edit_object['details'];
        $this->details_en=$this->edit_object['details_en'];

    }

    public function store_update()
    {
        $this->validate([
            'title'      =>  'required|max:200',
            'title_en'   =>  'required|max:200',
        ]);
        $data=new Notification();
        if(!empty($this->img))
        {
            $img=$this->img;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->title).'.'.$img->getClientOriginalExtension();
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
            //$image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            //$image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
            if(is_null($data->img_thumbnail)==0)
            {
                @unlink("./uploads/thumbnail/".$data->img_thumbnail);
            }
            $data->img = $file_name;
        }
        $users_onesignal_arr=array();
        $to_users=null;
        //
        if($this->type =='technicions')
        {
            //get technicions users
            $users_onesignal=User::select('id','onesignal_id')->where(['role_id'=>2])->get()->pluck('onesignal_id','id')->toArray();
            foreach ($users_onesignal as $user_onesignal) {
                if(!empty($user_onesignal))
                {
                    $users_onesignal_arr[]=$user_onesignal;
                }
            }
            $to_users=json_encode(array_keys($users_onesignal));
        }elseif($this->type =='workshops')
        {
            //get workshops users
            $users_onesignal=User::select('id','onesignal_id')->where(['role_id'=>3])->get()->pluck('onesignal_id','id')->toArray();
            foreach ($users_onesignal as $user_onesignal) {
                if(!empty($user_onesignal))
                {
                    $users_onesignal_arr[]=$user_onesignal;
                }
            }
            $to_users=json_encode(array_keys($users_onesignal));
        }elseif($this->type =='customers')
        {
            //get workshops users
            $users_onesignal=User::select('id','onesignal_id')->where(['role_id'=>1])->get()->pluck('onesignal_id','id')->toArray();
            foreach ($users_onesignal as $user_onesignal) {
                if(!empty($user_onesignal))
                {
                    $users_onesignal_arr[]=$user_onesignal;
                }
            }
            $to_users=json_encode(array_keys($users_onesignal));
        }
        $send_msg=sendMessage_onesignal_2app($this->type, $this->title,$this->details,@$file_name,$this->title_en,$this->details_en,[],$users_onesignal_arr);

        //
        $data->type=$this->type;
        $data->with_id=(int)$this->with_id;
        $data->title=$this->title;
        $data->title_en=$this->title_en;
        $data->details=$this->details;
        $data->details_en=$this->details_en;
        $data->to_users=$to_users;
        $data->response_notification=$send_msg;
        $object_added=$data->save();
        $this->emit('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->notification_id= null;
        $this->title= null;
        $this->title_en= null;
        $this->img= null;
        $this->img_icon= null;
        $this->img_type= null;
        $this->details= null;
        $this->details_en= null;

    }
}
