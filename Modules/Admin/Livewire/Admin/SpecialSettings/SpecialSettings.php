<?php

namespace Modules\Admin\Livewire\Admin\SpecialSettings;

use App\Models\SpecialSetting;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialSettings extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $title_page,$showForm,$showDeleted, $type ,$category_id;
    public $seo,$lang,$color;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $results=SpecialSetting::find(1);
        $this->color=$results->color;
        $this->seo=$results->seo;
        $this->lang=$results->lang;
        $this->title_page=__('ms_lang.speacial_setting');
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function render()
    {
        $results=SpecialSetting::find(1);
        return view('livewire.admin.special-settings.special-settings',[
            'results'=>$results
        ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function edit()
    {
        $data=SpecialSetting::find(1);
        $data->seo=$this->seo;
        $data->lang=$this->lang;
        $data->color=$this->color;
        $data->save();
        $this->refresh_edited();
    }

    public function deleted()
    {
        $this->showDeleted=!$this->showDeleted;
        $this->showForm=false;
        if($this->showDeleted == true)
        {
            $this->title_page='Deleted';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }
    public function edit_form($id=0)
    {
        $this->showForm=!$this->showForm;
        if($id > 0)
        {
            if($this->showForm == true)
            {
                $this->title_page='Edit';
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page='View';
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $edit_object= SpecialSetting::where('deleted_at',null)->whereId($id)->first();
        }
        else
        {
            if($this->showForm == true)
            {
                $this->title_page='Add';
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page='View';
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $add_object=new SpecialSetting();
            $edit_object=$add_object->get_new($this->type,$this->category_id);
        }
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }

    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        return redirect(request()->header('Referer'));
    }

    public function active_ms($id=0)
    {
        $data= SpecialSetting::select('id','is_active')->find($id);
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
        $data= SpecialSetting::select('id','deleted_at')->find($id);
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
