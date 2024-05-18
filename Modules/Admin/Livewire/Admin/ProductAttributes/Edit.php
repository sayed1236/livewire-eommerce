<?php

namespace Modules\Admin\Livewire\Admin\ProductAttributes;

use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$product_id,$stores,$img,$color_id,$amount,$size_id;
    public $price;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= ProductAttribute::find($this->edit_id);
        }
        else
        {
            $add_object=new ProductAttribute();
            $this->edit_object=$add_object->get_new();
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $attributs=AttributeValue::select('id','attribute_id','name','name_en','value')->get();
        $colors=$attributs->where('attribute_id','1');
        $sizes=$attributs->where('attribute_id','2');
        return view('admin::livewire.admin.product-attributes.edit',[
            'edit_object'=>$this->edit_object,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->product_id=$this->edit_object['product_id'];
        $this->size_id=$this->edit_object['size_id'];
        $this->img=$this->edit_object['img'];
        $this->price=$this->edit_object['price'];
        $this->amount=$this->edit_object['amount'];
        $this->color_id=$this->edit_object['color_id'];
    }

    // to insert or update one
    public function store_update()
    {
        // $this->validate([
        //     'name'      =>  'required|max:200',
        //     'name_en'   =>  'required|max:200',
        // ]);
        if($this->edit_id > 0)
        {
            $data= ProductAttribute::find($this->edit_id);
        }
        else
        {
            $data=new ProductAttribute();
        }
      if($data->img != $this->img)
        {
            $img=$this->img;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->size_id).'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(768,1024);
            $img_name = $image_data->save($destinationPath."/".$file_name);
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
            $data->img = $file_name;
        }
        $data->product_id=(int)$this->product_id;
        $data->size_id=(int)$this->size_id;
        $data->price=$this->price;
        $data->color_id=$this->color_id;
        $data->amount=$this->amount;
        $data->ord=$this->ord;
        $object_added=$data->save();
        $this->dispatch('objectEdit',$object_added);
    }
    

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->edit_id= null;
        $this->product_id= null;
        $this->size_id= null;
        $this->img= null;
        $this->price= null;
        $this->ord= null;
        $this->amount= null;
    }
}
