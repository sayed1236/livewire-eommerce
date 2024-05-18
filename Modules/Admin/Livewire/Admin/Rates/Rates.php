<?php

namespace Modules\Admin\Livewire\Admin\Rates;

use App\Models\Rate;
use Livewire\Component;

class Rates extends Component
{
    public $title_page,$CountriesCitye,$question_id,$showForm,$showDeleted,$btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($question_id=0)
    {
        $this->question_id=$question_id;
        if($this->question_id ==0)
        {
            $this->title_page=__('ms_lang.countries');
        }else
        {
            $this->title_page=__('ms_lang.cities');
        }
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {
        //whereParentId($this->question_id)->
        $results= Rate::with('user','user_rated','rated_in')->orderBy('is_approved','ASC')->get();
        return view('livewire.admin.rates.rates',
                    [
                        'results'=>$results,
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
            $edit_object= Rate::whereId($id)->first();
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
            $add_object=new Rate();
            $edit_object=$add_object->get_new($this->question_id);
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
    public function active_ms($id=0)
    {
        $data=Rate::select('id','is_approved')->find($id);
        if($data->is_approved == 'Y')
        {
            $data->is_approved='N';
        }
        else
        {
            $data->is_approved ='Y';
        }
        $data->save();
    }

    public function delete_ms($id=0)
    {
        $data=Rate::find($id)->delete();
        // if($data->deleted_at == null)
        // {
        //     $data->deleted_at=now();
        // }
        // else
        // {
        //     $data->deleted_at =null;
        // }
        // $data->save();
    }
}
