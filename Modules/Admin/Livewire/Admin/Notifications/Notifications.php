<?php

namespace Modules\Admin\Livewire\Admin\Notifications;

use App\Models\Admin\User;
use App\Models\Notification;
use Livewire\Component;

class Notifications extends Component
{

    public $title_page,$type,$with_id,$showForm,$showDeleted,$btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($type=0,$with_id=0)
    {
        $this->type=$type;
        $this->with_id=$with_id;
        if($this->type == 'technicions')
        {
            $this->title_page='الاشعارات للفنيين';
        }elseif($this->type == 'workshops')
        {
            $this->title_page='الاشعارات للورش';
        }elseif($this->type == 'customers')
        {
            $this->title_page='الاشعارات للعملاء';
        }else
        {
            $this->title_page='الاشعارات العامة';
        }

        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {

        $categories= Notification::whereType($this->type)->whereWithId($this->with_id)->get()->sortByDesc('id');
        return view('livewire.admin.notifications.notifications',
                    [
                        'results'=>$categories,
                    ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }

    public function edit_form($id=0)
    {
        $this->showForm=!$this->showForm;
        if($id > 0)
        {
            if($this->showForm == true)
            {
                $this->title_page=__('ms_lang.btn_edit');
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page=__('ms_lang.view');
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $edit_object= Notification::where('deleted_at',null)->whereId($id)->first();
        }
        else
        {
            if($this->showForm == true)
            {
                $this->title_page=__('ms_lang.btn_add_new');
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page=__('ms_lang.view');
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $add_object=new Notification();
            $edit_object=$add_object->get_new($this->type,$this->with_id);
        }
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }
    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        $this->showForm=false;
        $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function deleted()
    {
        $this->showDeleted=!$this->showDeleted;
        $this->showForm=false;
        $this->showFormEdit=false;
        if($this->showDeleted == true)
        {
            $this->title_page='Deleted Categories';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Categories';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }

    public function resend($id=0)
    {
        $old_notification=Notification::find($id);
        //dd($old_notification);
        if(is_null($old_notification)==0)
        {
            $data=new Notification();
            $users_onesignal_arr=array();
            $to_users=null;
            //
            if($old_notification->type =='technicions')
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
            }elseif($old_notification->type =='workshops')
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
            }elseif($old_notification->type =='customers')
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
            $send_msg=sendMessage_onesignal_2app($old_notification->type, $old_notification->title,$old_notification->details,@$old_notification->img,$old_notification->title_en,$old_notification->details_en,[],$users_onesignal_arr);

            //
            $data->type=$old_notification->type;
            $data->with_id=(int)$old_notification->with_id;
            $data->title=$old_notification->title;
            $data->title_en=$old_notification->title_en;
            $data->img=$old_notification->img;
            $data->details=$old_notification->details;
            $data->details_en=$old_notification->details_en;
            $data->to_users=$to_users;
            $data->response_notification=$send_msg;
            $object_added=$data->save();
            $this->emit('objectEdit',$object_added);
        }
        else
        {

        }
    }

    public function active_ms($id=0)
    {
        $data=Notification::select('id','is_active')->find($id);
        if($data->is_active == 'Y')
        {
            $data->is_active='N';
        }
        else
        {
            $data->is_active ='Y';
        }
        $data->save();
    }

    public function delete_ms($id=0)
    {
        $data=Notification::select('id','deleted_at')->find($id);
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
