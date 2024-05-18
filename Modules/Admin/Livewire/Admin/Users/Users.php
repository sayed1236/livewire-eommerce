<?php

namespace Modules\Admin\Livewire\Admin\Users;

use App\Models\Admin\User;
use App\Models\Rate;
use App\Models\Role;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title_page,$type,$role_id,$is_connect,$is_open_notifications,$mem_status,$role_name,$object_id;
    public $showDetails,$request_fields,$result_one;
    public $showFormEdit,$rate_results;
    public $showDeleted;
    public $btn_kwrd;
    public $view_user_object;
    protected $listeners=[
        'objectAdded'=>'refresh_results',
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($type=0,$role_id=0)
    {
        $this->type=$type;
        $this->role_id=$role_id;
        $this->role_name=Role::select('name','name_ar')->find($this->role_id);
        $this->showDetails=false;
        $this->showFormEdit=false;
        $this->showDeleted=false;
        if(Request('is_connect'))
        {
            $this->is_connect=Request('is_connect');
        }
        if(Request('is_open_notifications'))
        {
            $this->is_open_notifications=Request('is_open_notifications');
        }
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        $this->title_page=__('ms_lang.show').' : ';
        if((isset(request()->new) && request()->new == 'change-member-plan') || isset($this->request_fields['new']) )
        {
            $this->request_fields['new']=request()->new;
            $this->title_page.= Auth::user()->user_lang=='ar'? "طلبات تغيير العضويه" : "Requests Change member ship";
        }
        elseif((isset(request()->mem_status) && request()->mem_status == 'under-register')|| isset($this->mem_status) )
        {
            $this->mem_status=request()->mem_status;
            $this->title_page.= Auth::user()->user_lang=='ar'? "  العضويات الجاري تسجيلها" : "Requests Change member ship";
        }
        else
        {
            $this->title_page.= Auth::user()->user_lang=='ar'? @$this->role_name->name : @$this->role_name->name_en;
        }


    }
    public function render()
    {
        $user_query=User::with('user_detail')->where('role_id',$this->role_id);
        $results=$user_query->orderBy('id','DESC')->paginate(50);
        //dd($results);
        return view('livewire.admin.users.users',[
            'results'=>$results,
            'title_page'=>$this->title_page
            ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function create_form()
    {
        $this->showForm=!$this->showForm;
        $this->showFormEdit=false;
        if($this->btn_kwrd == __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>')
        {
            $this->title_page='Add Employees';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Employees';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }
    public function deleted()
    {
        $this->showDeleted=!$this->showDeleted;
        $this->showForm=false;
        $this->showFormEdit=false;
        if($this->showDeleted == true)
        {
            $this->title_page='Deleted Employees';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Employees';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }
    public function edit_form($id=0)
    {
        //dd($id);
        $this->showFormEdit=!$this->showFormEdit;
        $this->showForm=false;
        $this->view_user_object = User::with('user_detail')->find($id);
        if($this->view_user_object)
        {
            $this->emit('getObject',$this->view_user_object);
        }

        //dd($this->edit_object);
        if($this->showFormEdit == true)
        {
            $this->title_page='Edit Employee';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Employees';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }

    public function show($id)
    {
        $this->object_id=$id;
        $this->result_one=User::with('user_cars','user_detail')->withCount(['questions','questions_send_request_closed'])->find($id);
         //dd($this->result_one);
        $this->emit('openRecordsModal');
    }
    public function show_old($id=0)
    {
        //dd($id);
        $this->showDetails=!$this->showDetails;
        $edit_object = User::with('user_detail')->find($id);
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }

        //dd($edit_object);
        if($this->showFormEdit == true)
        {
            $this->title_page='Edit Employee';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Employees';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }

    public function rates($id)
    {
        $this->object_id=$id;
        $this->rate_results=Rate::with('user','rated_in')->where('rated_id',$id)->get();
         //dd($this->result_one);
        $this->emit('openRatesModal');
    }

    public function refresh_results($obj)
    {
        session()->flash('success_message','successfully doing');
        $this->showForm=false;

    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        $this->showForm=false;
        $this->showFormEdit=false;
    }

    public function active_ms($id=0)
    {
        $data= User::select('id','is_active')->find($id);
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

    public function change_member_plan($id=0)
    {
        $data= User::find($id);
        if($data->change_user_type >0 )
        {
            $data->role_id=$data->change_user_type;
            $data->change_user_type=0;
            $data->is_connect='Y';
            $data->save();
            if($data->onesignal_id != '')
            {
                $title="تغيير العضويه";
                $mesg="عميلنا العزيز تم الموافقة علي تغيير العضويه برجاء تسجيل الدخول مره اخري";
                $img= $data->profile_photo_path == '' ? '' :$data->profile_photo_path;
                sendMessage_onesignal_2app(1, $title,$mesg,@$img,'','',[],[$data->onesignal_id]);
            }

            session()->flash('success_message','successfully updated');
            $this->emit('new','change-member-plan');
        }
    }

    public function delete_ms($id=0)
    {
        //dd($id);
        $data= User::select('id','deleted_at')->find($id);
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
