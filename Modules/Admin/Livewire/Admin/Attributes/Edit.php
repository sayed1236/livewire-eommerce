<?php

namespace Modules\Admin\Livewire\Admin\Attributes;

use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$type,$name,$name_en;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= Attribute::where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new Attribute();
            $this->edit_object=$add_object->get_new($this->type);
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        return view('admin::livewire.admin.attributes.edit',[
            'edit_object'=>$this->edit_object,
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->type=$this->edit_object['type'];
        $this->ord=$this->edit_object['ord'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
    }

    // to insert or update one
    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
        ]);
        if($this->edit_id > 0)
        {
            $data= Attribute::find($this->edit_id);
        }
        else
        {
            $data=new Attribute();
        }
      
        $data->ord=(int)$this->ord;
        $data->type=(int)$this->type;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $object_added=$data->save();
        $this->dispatch('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->name= null;
        $this->name_en= null;

    }
}
