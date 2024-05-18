<?php

namespace Modules\Admin\Livewire\Admin\Shifts;

use App\Models\Shift;
use Livewire\Component;

class Shifts extends Component
{
    public $title_page;
    public $showForm;
    public $showFormEdit;
    public $showDeleted;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectAdded'=>'refresh_results',
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->title_page='View Shifts';
        $this->showForm=false;
        $this->showFormEdit=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {

        $results= Shift::get()->sortByDesc('id');
        return view('livewire.admin.shifts.shifts',
                    [
                        'results'=>$results,
                    ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }

    public function create_form()
    {
        $this->showForm=!$this->showForm;
        $this->showFormEdit=false;
        if($this->btn_kwrd == __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>')
        {
            $this->title_page='Add Shifts';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Shifts';
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
            $this->title_page='Deleted Shift';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View Shifts';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }
    public function edit_form($id=0)
    {
        //dd($id);
        $this->showFormEdit=!$this->showFormEdit;
        $this->showForm=false;
        $edit_object = Shift::find($id);
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }

        //dd($this->edit_object);
        if($this->showFormEdit == true)
        {
            $this->title_page='Edit Shift';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View shifts';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
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
        $data= Shift::select('id','is_active')->find($id);
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
        $data= Shift::select('id','deleted_at')->find($id);
        if($data->deleted_at == null)
        {
            $data->deleted_at=now();
        }
        else
        {
            $data->is_active =null;
        }
        $data->save();
    }
}
