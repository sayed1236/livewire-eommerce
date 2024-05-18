<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

use App\Models\Companysocial;
use App\Models\Product;
use App\Models\SocialMedia;
use App\Models\Socials as ModelsSocials;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Socials extends Component
{
    use WithFileUploads;

    public $name,$id_number,$address,$notes,$image,$products,$social_id,$value,$company_socials,$socials;

    public function render()
    {
        $this->socials=\App\Models\Socials::where('is_active','Y')->get();
        // $this->socials=\App\Models\Socials::where('is_active','y')->get();
// dd($this->socials);
        if (Auth::guard('companies')->user()) {
            $this->company_socials=Companysocial::where('company_id',Auth::guard('companies')->user()->id)->with('social')->get();
            // dd($this->company_socials);
          }
        return view('vendors::livewire.vendoe-account.socials');
    }
    public function add_product()
    {

        $this->validate([
            // 'name'=>'required',
            'value'=>'required',
            'social_id'=>'required',


        ]);
        // $this->image->store('photos');


        $data=new Companysocial();
        // $data->name =$this->name;
        $data->social_path=$this->value;
        $data->social_id=$this->social_id;
        // $data->img=$this->image->getfilename();
        $data->company_id=Auth::guard('companies')->user()->id;

        $data->save();

        session()->flash('success_message','  The social is added succesfully .');
        // $this->resetPassword();
        // return redirect()->route('login-home');
        return ('success_message');
    }
    public function activation($id)
        {
        $activation_state=Companysocial::find($id);
        if ($activation_state->is_active == 'Y') {
            $activation_state->is_active='N';
        }
            else {
                $activation_state->is_active='Y';
            }
        $activation_state->update();
        // dd($activation_state->is_active);
        }
}
