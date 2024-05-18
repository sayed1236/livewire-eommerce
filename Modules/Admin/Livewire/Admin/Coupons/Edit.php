<?php

namespace Modules\Admin\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;
    public $ord,$type,$name,$name_en,$img,$amount,$amount_taken,$date_expire,$max_num_uses,$coupon_code;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        if($this->edit_id > 0)
        {
            $this->edit_object= Coupon::where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new Coupon();
            $this->edit_object=$add_object->get_new($this->type);
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        return view('admin::livewire.admin.coupons.edit',[
            'edit_object'=>$this->edit_object
        ])->extends('admin::admin.layouts.app');
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->img=$this->edit_object['img'];
        $this->amount=$this->edit_object['amount'];
        $this->amount_taken=$this->edit_object['amount_taken'];
        $this->max_num_uses=$this->edit_object['max_num_uses'];
        $this->date_expire=$this->edit_object['date_expire'];
        $this->coupon_code=$this->edit_object['coupon_code'];

    }

    // to insert or update one
    public function store_update()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            'name_en'   =>  'required|max:200',
            'amount_taken'   =>  'required|max:200',

        ]);
        if($this->edit_id > 0)
        {
            $data= Coupon::find($this->edit_id);
        }
        else
        {
            $data=new Coupon();
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
            $image_data->resize(768,1024);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
           // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
            // finally we save the image as a new file
            $img_name = $image_data->save($destinationPath."/".$file_name);
            ///small img
            $image_small_data = Image::make($img->getRealPath());
            // now you are able to resize the instance
            $image_small_data->resize(190,250);
            // and insert a watermark for example
            $waterMarkUrl = public_path('uploads/logo.png');
            //$image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
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
        $data->name=$this->name;
        $data->name_en=$this->name_en;
        $data->amount=$this->amount;
        $data->amount_taken=$this->amount_taken;
        $data->coupon_code=$this->coupon_code;
        $data->date_expire=$this->date_expire;
        $data->max_num_uses=$this->max_num_uses;
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
        $this->img= null;
        $this->amount= null;
        $this->amount_taken= null;
        $this->max_num_uses= null;
        $this->coupon_code= null;

    }
}
