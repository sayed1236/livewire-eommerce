<?php

namespace Modules\Trader\Livewire\TraderAccount;
use Livewire\Attributes\Rule;
use App\Models\trader\Trader;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class Details extends Component
{
    use WithFileUploads;

    // #[Rule('required|min:3')] 
    public $photo = '',$user;

    public $fullname = '';
    #[Rule('email|min:7|max:20')] 
    public $email = '';   
    public $cur_password = '';
    // #[Rule('confirmed')] 
    // #[Rule('required')] 
    public function render()
    {
        $this->user=Trader::find(auth()->guard('trader')->user()->id);
        return view('trader::livewire.trader-account.details');
    }
    public function edit_details(){
        // $this->validate();
            $getuser = Trader::find(auth()->guard('trader')->user()->id);
            if($this->photo!=='')
            {
                $img=$this->photo;
                $file_name = date('Y_m_d_h_i_s_').Str::slug($this->fullname).'.'.$img->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image_data = Image::make($img->getRealPath());
                $img_name = $image_data->save($destinationPath."/".$file_name);
                if(is_null($getuser->img)==0)
                {
                    @unlink("./uploads/".$getuser->img);
                }
                $getuser->img = $file_name;
                // $this->is_photo = $file_name;
            }            
            if ($this->fullname !== '') {
                $getuser->name = $this->fullname;
            }
            if ($this->email !== '') {
                $getuser->email = $this->email;
            }
            if ($this->cur_password !== '') {
                $getuser->password = Hash::make($this->cur_password); // Hash the new password
            }
            $getuser->save();
            $this->fullname = '';
            $this->email = '';
            $this->cur_password = '';
            $this->new_password = '';
    }
    
}
