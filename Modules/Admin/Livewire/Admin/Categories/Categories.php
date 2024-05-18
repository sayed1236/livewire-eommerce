<?php

namespace Modules\Admin\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class Categories extends Component
{
    public $title_page,$type,$parent_id,$showForm,$showDeleted,$btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
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
            $edit_object= Category::where('deleted_at',null)->whereId($id)->first();
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
            $add_object=new Category();
            $edit_object=$add_object->get_new($this->type,$this->parent_id);
        }
        if($edit_object)
        {

            $this->dispatch('get-object', ['edit_object'=>$edit_object ,'showForm'=>$this->showForm ]);

        }
    }
    public function mount($type=0,$parent_id=0)
    {
        $this->type=$type;
        $this->parent_id=$parent_id;
        if($this->parent_id ==0)
        {
            $this->title_page=__('ms_lang.categories');
        }
        else
        {
            $this->title_page=__('ms_lang.sub_categories');
        }
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';

    }
    public function render()
    {

        $categories= Category::whereType($this->type)->whereParentId($this->parent_id)->get()->sortByDesc('ord');
        return view('admin::livewire.admin.categories.categories',
                    [
                        'results'=>$categories,
                    ])->extends('admin::admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }


    #[On('objectEdit')]
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
        // dd('jk');
        $data=Category::select('id','is_active')->find($id);
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
        $data=Category::select('id','deleted_at')->find($id);
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
