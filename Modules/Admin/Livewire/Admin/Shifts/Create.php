<?php

namespace Modules\Admin\Livewire\Admin\Shifts;

use App\Models\Shift;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;
    public $ord;
    public $type;
    public $parent_id;
    public $name;
    public $name_en;
    public $img;
    public function render()
    {
        return view('livewire.admin.shifts.create');
    }
    public function store()
    {
        $this->validate([
            'name'      =>  'required|max:200',
            'name_en'   =>  'required|max:200',
        ]);
        if($img = $this->img)
        {
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
            $data['img'] = $file_name;

        }
        $data['ord']=(int)$this->ord;
        $data['name']=$this->name;
        $data['name_en']=$this->name_en;
        $object_added=Shift::create($data);
        $this->reset_inputs();
        $this->emit('objectAdded',$object_added);
        // session()->flush('success_message','successfully added');
        // return redirect()->to(config('app.url_admin').'category');

    }

    public function reset_inputs()
    {
        $this->ord= null;
        $this->name= null;
        $this->name_en= null;
    }
}
