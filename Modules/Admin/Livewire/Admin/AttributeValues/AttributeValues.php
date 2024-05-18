<?php

namespace Modules\Admin\Livewire\Admin\AttributeValues;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeValues extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $title_page,$showForm,$showDeleted, $type,$attribute_id;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($attribute_id=0,)
    {
        $attribute_id_data=Attribute::find($attribute_id);
        $this->attribute_id=$attribute_id;
        $this->title_page=(isset($attribute_id_data) ? $attribute_id_data->name : '');
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function render()
    {
        $results=AttributeValue::with('attribute')->where(['attribute_id'=>$this->attribute_id])->paginate();
        return view('admin::livewire.admin.attribute-values.attribute-values',[
            'results'=>$results
        ])->extends('admin::admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
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
            $edit_object= AttributeValue::where('deleted_at',null)->whereId($id)->first();
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
            $add_object=new AttributeValue();
            $edit_object=$add_object->get_new($this->attribute_id);
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

    public function active_ms($id=0)
    {
        $data= AttributeValue::select('id','is_active')->find($id);
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
        $data= AttributeValue::select('id','deleted_at')->find($id);
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
