<?php

namespace Modules\Admin\Livewire\Admin\AttributeValues;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$type,$name,$name_en,$attribute_id,$value;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= AttributeValue::where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new AttributeValue();
            $this->edit_object=$add_object->get_new($this->type);
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $attributes=Attribute::select('id','name','name_en')->where('type',1)->get();
        return view('admin::livewire.admin.attribute-values.edit',[
            'edit_object'=>$this->edit_object,
            'attributes'=>$attributes,
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->attribute_id=$this->edit_object['attribute_id'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->value=$this->edit_object['value'];
    }

    // to insert or update one
    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
        ]);
        if($this->edit_id > 0)
        {
            $data= AttributeValue::find($this->edit_id);
        }
        else
        {
            $data=new AttributeValue();
        }
        $data->ord=(int)$this->ord;
        $data->attribute_id=(int)$this->attribute_id;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->value=$this->value;
        $object_added=$data->save();
        $this->emit('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->name= null;
        $this->name_en= null;
        $this->attribute_id= null;
        $this->value= null;
    }
}
