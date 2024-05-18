<?php

namespace Modules\Admin\Livewire\Admin\Gallaries;

use App\Models\Gallery;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$type,$name,$name_en,$img,$img_icon,$img_type,$details,$details_en,$cat_id;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= Gallery::where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new Gallery();
            $this->edit_object=$add_object->get_new($this->type);
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $categories=Category::select('id','name')->where('parent_id',0)->get();
        return view('admin::livewire.admin.galleries.edit',[
            'edit_object'=>$this->edit_object,
            'categories'=>$categories,
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->type=$this->edit_object['type'];
        $this->cat_id=$this->edit_object['cat_id'];
        $this->ord=$this->edit_object['ord'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->img=$this->edit_object['img'];
        $this->img_icon=$this->edit_object['img'];
        $this->img_type= $this->type ==1 ? 'icon':'';
        // $this->details=$this->edit_object['details'];
        // $this->details_en=$this->edit_object['details_en'];
    }

    // to insert or update one
    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            'name_en'   =>  'required|max:200',
        ]);
        if($this->edit_id > 0)
        {
            $data= Gallery::find($this->edit_id);
        }
        else
        {
            $data=new Gallery();
        }
        if($data->img != $this->img)
        {
            $img=$this->img;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
            //  $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            // $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            //$image_data->resize(1024,768);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/watermark1.png');
            // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            // $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance

            // $image_small_data->resize(250,190);
            // and insert a watermark for example
            // $waterMarkUrl = public_path('uploads/watermark1.png');
            // $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
            // finally we save the image as a new file
            // $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
            $data->img = $file_name;
        }

        $data->ord=(int)$this->ord;
        $data->type=(int)$this->type;
        $data->cat_id=(int)$this->cat_id;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        // $data->details=$this->details;
        // $data->details_en=$this->details_en;
        $object_added=$data->save();
        $this->dispatch('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->cat_id= null;
        $this->name= null;
        $this->name_en= null;
        $this->img= null;
        $this->img_icon= null;
        $this->img_type= null;
        $this->details= null;
        $this->details_en= null;

    }
}
