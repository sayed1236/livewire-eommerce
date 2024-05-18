<?php

namespace Modules\Admin\Livewire\Admin\SocialMedias;

use App\Models\SocialMedia;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$ord_footer,$name,$img,$img_icon,$img_type,$class_so,$url_link;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];

    public function mount()
    {
        $this->edit_object= SocialMedia::where('deleted_at',null)->find($this->edit_id);
    }
    public function render()
    {
        return view('admin::livewire.admin.social-medias.edit',[
            'edit_object'=>$this->edit_object
        ])->extends('admin::admin.layouts.app',['script_editor'=>true]);
    }

    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->ord_footer=$this->edit_object['ord_footer'];
        $this->name=$this->edit_object['name'];
        $this->class_so=$this->edit_object['class_so'];
        $this->img=$this->edit_object['img'];
        $this->img_icon=$this->edit_object['img'];
        $this->img_type= $this->edit_object['img_type'];
        $this->url_link=$this->edit_object['url_link'];

    }

    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            'url_link'   =>  'required',
        ]);
        if($this->edit_id > 0)
        {
            $data= SocialMedia::find($this->edit_id);
        }
        else
        {
            $data=new SocialMedia();
        }
        if($this->img_type == 'icon')
        {
            $data->img=$this->img_icon;

        }
        elseif($data->img != $this->img)
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
            $image_data->resize(768,1024);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
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
        }

        $data->ord=(int)$this->ord;
        $data->ord_footer=(int)$this->ord_footer;
        $data->name=$this->name;
        $data->class_so=$this->class_so;
        $data->url_link=$this->url_link;
        $object_added=$data->save();
        $this->dispatch('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->edit_id= null;
        $this->ord= null;
        $this->ord_footer= null;
        $this->name= null;
        $this->name_en= null;
        $this->img= null;
        $this->class_so= null;
        $this->img_type= null;
        $this->url_link= null;

    }
}
