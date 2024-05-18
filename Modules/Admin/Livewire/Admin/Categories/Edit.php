<?php
namespace Modules\Admin\Livewire\Admin\Categories;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Models\SeoPage;
use App\Models\SpecialSetting;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    #[Rule('required')]
    public $name = '';
    public $edit_object;
    public $ord,$type,$parent_id,$img,$img_icon,$img_type,$details;
    public $keywords,$details_seo,$choose_viewd,$img_nave;
    public $edit_id,$showForm;
    // protected $listeners=[
    //     'getObject' => 'get_object'
    // ];



    #[On('get-object')]
    public function getObject($edit_object)
    {
        // dd($edit_object);
        $object_res=$edit_object['edit_object'];
        $this->showForm =$edit_object['showForm'];
        $this->edit_object=$object_res;
        $this->edit_id=$this->edit_object['id'];
        $this->ord=$this->edit_object['ord'];
        $this->type=$this->edit_object['type'];
        $this->parent_id=$this->edit_object['parent_id'];
        $this->name=$this->edit_object['name'];
        $this->choose_viewd=$this->edit_object['choose_viewd'];
        $this->img=$this->edit_object['img'];
        $this->img_nave=$this->edit_object['img_nave'];
        $this->img_icon=$this->edit_object['img'];
        $this->img_type= $this->type < 2 ? '':'icon';
        $this->details=$this->edit_object['details'];
        $edit_object_seo= SeoPage::where('deleted_at',null)->where('table_id', $this->edit_id)->first();
        if ($edit_object_seo != null) {
            $this->keywords=$edit_object_seo->keywords;
            $this->details_seo=$edit_object_seo->description;
        }
        
    }
    public function store_update()
    {
        $this->validate();

        if($this->edit_id > 0)
        {
            $data= Category::find($this->edit_id);
            $data_seo= SeoPage::where(['table_id'=>$this->edit_id,'table_name'=>'categories'])->first();
        }
        else
        {
            $data=new Category();
            $data_seo=new SeoPage();
        }

        if($this->img_type == 'icon')
        {
            $data->img=$this->img_icon;
        }
        elseif(is_file($this->img))
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
        if($data->img_nave != $this->img_nave)
        {
            $img=$this->img_nave;
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
            if(is_null($data->img_nave)==0)
            {
                @unlink("./uploads/".$data->img_nave);
            }
            // if(is_null($data->img_thumbnail)==0)
            // {
            //     @unlink("./uploads/thumbnail/".$data->img_thumbnail);
            // }
            $data->img_nave = $file_name;
        }
        $data->ord=(int)$this->ord;
        $data->type=(int)$this->type;
        $data->parent_id=(int)$this->parent_id;
        $data->name=$this->name;
        $data->choose_viewd='N';
        $data->details=$this->details;
        $object_added=$data->save();

        if (isset($data->id) && $data_seo !=null) {
            $data_seo->table_id=$data->id;
            $data_seo->table_name='categories';
            $data_seo->keywords=$this->keywords;
            $data_seo->description=$this->details_seo;
            $data_seo->save();
        }else{
            $data_seo=new SeoPage();
            $data_seo->table_id=$data->id;
            $data_seo->table_name='categories';
            $data_seo->keywords=$this->keywords;
            $data_seo->description=$this->details_seo;
            $data_seo->save();
        }
        $this->reset_inputs();
        $this->showForm=false;
        $this->dispatch('objectEdit',$object_added);
    }

    // to reset inputs after insert
    public function reset_inputs()
    {
        $this->type= null;
        $this->edit_id= null;
        $this->ord= null;
        $this->name= null;
        $this->img_nave= null;
        $this->choose_viewd= null;
        $this->img_icon= null;
        $this->img_icon= null;
        $this->img_type= null;
        $this->details= null;
        $this->keywords= null;
        $this->details_seo= null;

    }
    public function mount()
    {
        $this->showForm=false;
        // $this->edit_object= Category::where('deleted_at',null)->find($this->edit_id);
    }
    public function render()
    {
        $special_data=SpecialSetting::find(1);
        return view('admin::livewire.admin.categories.edit',[
            // 'edit_object'=>$this->edit_object,
            'special_data'=>$special_data,
        ])->extends('admin::admin.layouts.app',['script_editor'=>true]);
    }

}
