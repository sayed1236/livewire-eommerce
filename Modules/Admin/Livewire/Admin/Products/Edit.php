<?php

namespace Modules\Admin\Livewire\Admin\Products;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ProductAttribute, $ord,$type,$category_id,$stores,$color_id,$name,$name_en,$img,$details,$details_en,$product_code,$discount,$is_used,$stoke_id,$tag,$tag_en;
    public $price,$quntity=[],$size_id=[],$templates=[''],$mul_img=[],$Productsizes,$product_gallaries,$quan,$brand_id;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= Product::find($this->edit_id);
        }
        else
        {
            $add_object=new Product();
            $this->edit_object=$add_object->get_new();
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $colors=AttributeValue::select('id','attribute_id','name','value')->where('attribute_id',1)->get();
        $sizes=AttributeValue::select('id','attribute_id','name','value')->where('attribute_id',2)->get();
        $categories=Category::with('sub_category')->select('id','name','name_en')->where('parent_id','0')->get();
        $brands=Category::with('sub_category')->select('id','name','name_en','type')->where('parent_id','0')->where('type','1')->get();
        // dd($brands);
        // $Productsizes = ProductAttribute::
        
        return view('admin::livewire.admin.products.edit',[
            'edit_object'=>$this->edit_object,
            'categories'=>$categories,
            'colors'=>$colors,
            'sizes'=>$sizes,
            'brands'=>$brands,
        ])->extends('admin::admin.layouts.app');
    }
    function add()
    {
        $this->templates[]='';
    }
    public function remove($index)
    {
        unset($this->templates[$index]);
        $this->templates=array_values($this->templates);
    }
   
    
    public function edit_get_countity($id)
    {
        if($id){
            $this->ProductAttribute = ProductAttribute::find($id);
            $this->size_id[]=$this->ProductAttribute->size_id;
            $this->quntity[] = $this->ProductAttribute->amount;
        }
     
       
    }
    public function save($index){
        
       $products =  ProductAttribute::find($this->ProductAttribute->id);
       $products->update([
        'size_id'=>$this->size_id[0],
        'amount'=>$this->quntity[0]
     ]);
     $this->size_id[0] = null;
     $this->quntity[0] = null;
    // $this->emit('render');

    }
    public function remove_exist($index)
    {      
       
         $data=ProductAttribute::where('id',$id);
         $data->delete();
    }
  
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->type=$this->edit_object['type'];
        $this->brand_id=$this->edit_object['brand_id'];
        $this->category_id=$this->edit_object['category_id'];
        $this->stoke_id=$this->edit_object['stoke_id'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->img=$this->edit_object['img'];
        $this->price=$this->edit_object['price'];
        $this->discount=$this->edit_object['discount'];
        $this->color_id=$this->edit_object['color_id'];
        $this->tag=$this->edit_object['tag'];
        $this->tag_en=$this->edit_object['tag_en'];
        $this->product_code=$this->edit_object['product_code'];
        $this->details=$this->edit_object['details'];
        $this->is_used=$this->edit_object['is_used'];
        $this->details_en=$this->edit_object['details_en'];
        if($this->edit_id > 0){
             $this->Productsizes=$this->edit_object['product_attributes'];
             $this->product_gallaries=$this->edit_object['gallaries'];
        }
    }

    // to insert or update one
    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
        ]);
        if($this->edit_id > 0)
        {
            $data= Product::find($this->edit_id);
        }
        else
        {
            $data=new Product();
            $data->barcode_number=randomNumber(10);
        }
        if($data->img != $this->img)
            {
                $img=$this->img;
                $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
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
        $data->category_id=(int)$this->category_id;
        $data->brand_id=(int)$this->brand_id;
        $data->stoke_id=(int)$this->stoke_id;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->price=$this->price;
        $data->product_code=$this->product_code;
        $data->discount=(int)$this->discount;
        $data->color_id=$this->color_id;
        $data->is_used=$this->is_used;
        $data->tag=$this->tag;
        $data->tag_en=$this->tag_en;
        $data->ord=$this->ord;
        $data->type=$this->type;
        $data->details=$this->details;
        $data->details_en=$this->details_en;
        $object_added=$data->save();
        if (count($this->mul_img)) {
            $il=1;
            foreach ($this->mul_img as  $img) {
                $data_imges=new Gallery;

                $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).$il.'.'.$img->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image_data = Image::make($img->getRealPath());
                // now you are able to resize the instance
                $image_data->resize(768,1024);
                $img_name = $image_data->save($destinationPath."/".$file_name);
                $data_imges->img = $file_name;
                $data_imges->product_id=$data->id;
                $data_imges->save();
                $il++;
            }
        }
        if ($object_added== true && count($this->size_id) != 0) {
            foreach ($this->size_id as $key => $value) {
                $data_attripute=new ProductAttribute;
                $data_attripute->size_id=$value;
                $data_attripute->color_id=$this->color_id;
                $data_attripute->product_id=$data->id;
                $data_attripute->amount=$this->quntity[$key];
                $data_attripute->save();
            }
        }
        $this->emit('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->edit_id= null;
        $this->category_id= null;
        $this->brand_id= null;
        $this->stoke_id= null;
        $this->name= null;
        $this->name_en= null;
        $this->img= null;
        $this->price= null;
        $this->details= null;
        $this->details_en= null;
        $this->tag= null;
        $this->tag_en= null;
        $this->ord= null;
        $this->discount= null;
        $this->color_id= null;
    }

    public function delete_img_ms($id=0)
    {
        $data= Gallery::select('id','deleted_at')->find($id);
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
