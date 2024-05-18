<?php

namespace Modules\Admin\Livewire\Admin\Advertisings;

use App\Models\Advertising;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$type,$with_id,$name,$name_en,$img,$img_thumbnail,$url_l,$google_adv,
        $v_in_home,$v_in_slide,$v_in_app,$img_icon,$img_type,$details,$details_en;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= Advertising::where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new Advertising();
            $this->edit_object=$add_object->get_new($this->type,$this->with_id);
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $categories=Category::get();
        return view('admin::livewire.admin.advertisings.edit',[
            'edit_object'=>$this->edit_object,
            'categories'=>$categories
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->type=$this->edit_object['type'];
        $this->with_id=$this->edit_object['with_id'];
        $this->ord=$this->edit_object['ord'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->img=$this->edit_object['img'];
        $this->img_thumbnail=$this->edit_object['img_thumbnail'];
        $this->url_l= $this->edit_object['url_l'];
        $this->google_adv=$this->edit_object['google_adv'];
        $this->v_in_home=$this->edit_object['v_in_home'];
        $this->v_in_slide=$this->edit_object['v_in_slide'];
        $this->v_in_app=$this->edit_object['v_in_app'];
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
            $data= Advertising::find($this->edit_id);
        }
        else
        {
            $data=new Advertising();
        }
        if($data->img != $this->img)
        {
            $img=$this->img;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
            $file_sml_name_img = 'thumbnail_'.$file_name;
            $destinationPath = public_path('/uploads');
            $destinationPath_smll = public_path('/uploads/thumbnail');
            // to finally create image instances
            //$image = $manager->make($destinationPath."/".$file_name);
            $image_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_data->resize(1024,768);
            // and insert a watermark for example
            //$waterMarkUrl = public_path('uploads/logo.png');
            //$image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(250,190);
            // and insert a watermark for example
            //$waterMarkUrl = public_path('uploads/watermark.png');
            //$image_small_data->insert($waterMarkUrl, 'bottom-right', 3, 3);
            // finally we save the image as a new file
            $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
            // exit create img
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
            if(is_null($data->img_thumbnail)==0)
            {
                @unlink("./uploads/thumbnail/".$data->img_thumbnail);
            }
            $data->img = $file_name;
            $data->img_thumbnail = $file_sml_name_img;
        }
        $data->ord=(int)$this->ord;
        $data->type=$this->type;
        $data->with_id=(int)$this->with_id;
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->url_l=$this->url_l;
        $data->google_adv=$this->google_adv;
        $data->v_in_home=$this->v_in_home;
        $data->v_in_slide=$this->v_in_slide;
        $data->v_in_app=$this->v_in_app;
        $object_added=$data->save();
        $this->emit('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->with_id= null;
        $this->name= null;
        $this->name_en= null;
        $this->img= null;
        $this->img_icon= null;
        $this->img_type= null;
        $this->details= null;
        $this->details_en= null;

    }
}
