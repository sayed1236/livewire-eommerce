<?php

namespace Modules\Admin\Livewire\Admin\Stores;

use App\Models\Category;
use App\Models\CountriesCity;
use App\Models\ServiceContact;
use App\Models\Store;
use App\Models\StoreContact;
use App\Models\StoreGallary;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    use WithFileUploads;
    public $multi_img,$img_id,$get_multi_img,$contact=[],$type,$sub_categories,$sub_category_id,$name_en,$img,$img_icon,$img_type,$note_en;
    public $city_id,$note,$name,$latitude,$longitude,$work_time_to,$work_time_from,$category_id;
    public $edit_object;
    public $edit_id;
    protected $listeners=[
        'getObject' => 'get_object'
    ];
    public function mount()
    {
        $this->multi_img=[];
        if($this->edit_id > 0)
        {
            $this->edit_object= Store::with(['contactValues','category'])->where('deleted_at',null)->find($this->edit_id);
        }
        else
        {
            $add_object=new Store();
            $this->edit_object=$add_object->get_new();
        }
        //dd($this->edit_object);
    }
    public function render()
    {
        $categories=Category::select('id','name','name_en')->where('parent_id',0)->get();
        $cities=CountriesCity::select('id','name','name_en')->where('parent_id','>',0)->get();
        $contactes=ServiceContact::all();
        return view('livewire.admin.stores.edit',[
            'edit_object'=>$this->edit_object,
            'categories'=>$categories,
            'cities'=>$cities,
            'contactes'=>$contactes,
        ])->extends('admin.layouts.app');
    }
    public function get_sub_gategory()
    {
        $this->sub_categories=Category::where('parent_id',$this->category_id)->get();
    }
    public function get_object($edit_object)
    {
        $this->edit_object=$edit_object;
        $this->edit_id=$this->edit_object['id'];
        $this->latitude=$this->edit_object['latitude'];
        $this->longitude=$this->edit_object['longitude'];
        $this->work_time_from=$this->edit_object['work_time_from'];
        $this->work_time_to=$this->edit_object['work_time_to'];
        $this->name=$this->edit_object['name'];
        $this->name_en=$this->edit_object['name_en'];
        $this->img=$this->edit_object['img']; 
        $this->city_id=$this->edit_object['city_id']; 
        $this->note=$this->edit_object['note'];
        $this->note_en=$this->edit_object['note_en'];
        if($edit_object['id'] == 0){
            $this->category_id=$this->edit_object['category_id'];
        }else{
           
            if(isset($edit_object['contact_values'])){
                foreach ($edit_object['contact_values'] as $contactValue) {
                    $this->contact +=[$contactValue['contact_service_id']=>$contactValue['value']];
                }
            }
            if(isset($this->edit_object['category'])){
                $this->category_id=$this->edit_object['category']['parent_id'];
                $this->sub_category_id=$this->edit_object['category']['id'];
                $this->sub_categories=Category::where('parent_id',$this->edit_object['category']['parent_id'])->get();
            }
            $this->get_multi_img=StoreGallary::where('store_id',$this->edit_object['id'])->get();
        }
    }
    public function get_ask($id)
    {
        $this->img_id=$id;
    }
    public function delete()
    {
        $img=StoreGallary::find($this->img_id);
        if($img!=null)
        {
            @unlink("./uploads/".$img->img);
            $img->delete();
        }
        $this->get_multi_img=StoreGallary::where('store_id',$this->edit_object['id'])->get();
        $this->emit('remove_modal');
    }

    // to insert or update one
    public function store_update()
    {
        try {
            DB::beginTransaction();
            $this->validate([
                'name'      =>  'required|max:200',
                'name_en'   =>  'required|max:200',
                // 'store_id'   =>  'required',
            ]);

            if($this->edit_id > 0)
            {
                $data= Store::find($this->edit_id);
            }
            else
            {
                $data=new Store();
            }

        if($data->img != $this->img)
            {
                $img=$this->img;
                $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
                // $file_sml_name_img = 'thumbnail_'.$file_name;
                $destinationPath = public_path('/uploads');
                // $destinationPath_smll = public_path('/uploads/thumbnail');
                // to finally create image instances
                //$image = $manager->make($destinationPath."/".$file_name);
                $image_data = Image::make($img->getRealPath());
                // now you are able to resize the instance
                $image_data->resize(768,1024);
                // and insert a watermark for example
                // $waterMarkUrl = public_path('uploads/logo.png');
                // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
                // finally we save the image as a new file
                $img_name = $image_data->save($destinationPath."/".$file_name);
                ///small img
                $image_small_data = Image::make($img->getRealPath());
                // now you are able to resize the instance
                $image_small_data->resize(190,250);
                // and insert a watermark for example
                // $waterMarkUrl = public_path('uploads/logo.png');
                // $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
                // finally we save the image as a new file
                // $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
                // exit create img
                if(is_null($data->img)==0)
                {
                    @unlink("./uploads/".$data->img);
                }
                // if(is_null($data->img_thumbnail)==0)
                // {
                //     @unlink("./uploads/thumbnail/".$data->img_thumbnail);
                // }
                $data->img = $file_name;
            }
            

            $data->city_id=$this->city_id;
            $data->category_id=(int)$this->sub_category_id;
            $data->longitude=$this->longitude;
            $data->latitude=$this->latitude;
            $data->work_time_to=$this->work_time_to;
            $data->work_time_from=$this->work_time_from;
            $data->name=$this->name;
            $data->name_en=$this->name_en;
            $data->note=$this->note;
            $data->note_en=$this->note_en;
            $object_added=$data->save();

           // multi imge for store
           if($this->multi_img){
            foreach($this->multi_img as $imgee){
                $img=$imgee;
                    $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalName().'.'.$img->getClientOriginalExtension();
                    $file_sml_name_img = 'thumbnail_'.$file_name;
                    $destinationPath = public_path('/uploads');
                    $destinationPath_smll = public_path('/uploads/thumbnail');
                    // to finally create image instances
                    //$image = $manager->make($destinationPath."/".$file_name);
                    $image_data = Image::make($img->getRealPath());
                    // now you are able to resize the instance
                    $image_data->resize(1024,768);
                    // and insert a watermark for example
                    // $waterMarkUrl = public_path('uploads/logo.png');
                    // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
                    // finally we save the image as a new file
                    $img_name = $image_data->save($destinationPath."/".$file_name);
                    ///small img
                    $image_small_data = Image::make($img->getRealPath());
                    // now you are able to resize the instance
                    $image_small_data->resize(250,190);
                    // and insert a watermark for example
                    // $waterMarkUrl = public_path('uploads/logo.png');
                    // $image_small_data->insert($waterMarkUrl, 'bottom-right', 2, 2);
                    // finally we save the image as a new file
                    $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
                    // exit create img
                    // if(is_null($data->img)==0)
                    // {
                    //     @unlink("./uploads/".$data->img);
                    // }
                    // if(is_null($data->img_thumbnail)==0)
                    // {
                    //     @unlink("./uploads/thumbnail/".$data->img_thumbnail);
                    // }
                    $this->imageee=$file_name;
                    $this->imageee_thum=$file_sml_name_img;
                    StoreGallary::create([
                        'store_id'=>$data->id,
                        'img'=> $this->imageee,
                        'img_thumbanil'=> $this->imageee_thum,
                    ]);
            }
            }
            // contact for adver
             foreach ($this->contact as  $key=>$value) {
                 $data_contact=StoreContact::where('store_id',$data->id)->where('contact_service_id',$key)->first();
                 if($data_contact != null){
                    $data_contact->value=$value;
                    $data_contact->save();
                 }else{
                    StoreContact::create([
                        'store_id'=>$data->id,
                        'contact_service_id'=>$key,
                        'value'=>$value,
                    ]);
                }
            }

            $this->emit('objectEdit',$object_added);
            DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
        session()->flash('error', 'يوجد هناك شئ ما خطأ');
    }
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->latitude= null;
        $this->longitude= null;
        $this->work_time_to= null;
        $this->work_time_from= null;
        $this->city_id= null;
        $this->category_id= null;
        $this->name= null;
        $this->name_en= null;
        $this->img= null;
        $this->note= null;
        $this->note_en= null;

    }
}
