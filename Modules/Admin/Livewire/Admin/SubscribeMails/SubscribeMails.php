<?php

namespace Modules\Admin\Livewire\Admin\SubscribeMails;

use App\Mail\SubscribeMail as MailSubscribeMail;
use App\Models\Admin\User;
use App\Models\SubscribeMail;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscribeMailsMessage;
use Illuminate\Support\Facades\Auth;

class SubscribeMails extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $title_page,$showForm,$message, $subject ,$emails;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->emails=[];
        $this->title_page='القائمه البريديه';//__('ms_lang.stores');
    }

    public function render()
    {
        $results=User::where('role_id',1)->paginate();
        return view('livewire.admin.subscribe-mails.subscribe-mails',[
            'results'=>$results
        ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    
    public function send_email()
    {
        $this->validate([
            'subject'      =>'required',
            'message'   => 'required',
            'emails' => 'required'
        ]);
        $data= new SubscribeMailsMessage();
        $data->subject=$this->subject;
        $data->message=$this->message;
        $data->emails=implode(',',$this->emails);
        $data->user_ip=request()->ip();
        $data->user_pc_info=request()->header('User-Agent');
        $data->user_added = Auth::id();
        $data->save();
        //to send email confirm
        $send_mail_obj = new \stdClass();
        $send_mail_obj->subject = $this->subject;
        $send_mail_obj->sender = config('app.name').' team';
        $send_mail_obj->message = $this->message;
        $send_mail=Mail::to($this->emails)
                        // ->cc($moreUsers)
                        // ->bcc($evenMoreUsers)
                        ->send(new MailSubscribeMail($send_mail_obj));
        if(Mail:: failures())
        {
            session()->flash('success_message','عفوا هناك خطأ ما: '.Mail:: failures());
        }
        else
        {
            session()->flash('success_message','تم الارسال بنجاح');
        }
    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        $this->showForm=false;
        $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function delete_ms($id=0)
    {
        $data= SubscribeMail::select('id','deleted_at')->find($id);
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
