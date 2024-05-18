<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Details extends Component
{
    public $user,$id ,$name, $img, $mobile, $email,$old_password,$new_password,$confirm_pass;

    public function mount()
    {
       if ($this->user=Auth::guard('companies')->user()) {
        $this->user=Auth::guard('companies')->user();
        $this->id= $this->user->id;
        $this->name= $this->user->name;
        $this->mobile= $this->user->mobile;
        $this->email= $this->user->email;
        // dd($this->email);
     }
    }
    public function render()
    {
    //    if ($this->user=Auth::guard('companies')->user()) {
    //     $this->user=Auth::guard('companies')->user();
    //     $this->id= $this->user->id;
    //     $this->name= $this->user->name;
    //     $this->mobile= $this->user->mobile;
    //     $this->email= $this->user->email;
        // dd($this->email);
    //  }

        return view('vendors::livewire.vendoe-account.details');
    }
    public function update_data()
    {
        if ($this->user=Auth::guard('companies')->user()) {
         $vendor=Company::where('id',Auth::guard('companies')->user()->id)->first();
        //  dd($vendor);
         $vendor->name=$this->name;
         $vendor->email=$this->email;
         $vendor->password=$this->password;
         }

    }
    public function updatePassword( )
    {

            # Validation
            $this->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_pass' => 'required',
            ]);
// dd($this->new_password);
            if($this->confirm_pass != $this->new_password){
            return session()->flash('confirm',"Passwords  do not match!");

             }
            #Match The Old Password
            elseif(!Hash::check($this->old_password, Auth::guard('companies')->user()->password)){
                // return back()->with("error", "Old Password Doesn't match!");
                // dd('2');
                return  session()->flash('old_pass',"verify from your password!");


            }

            // dd('3');

            #Update the new Password
            else{
            Company::whereId(auth()->user()->id)->update([
                'password' => Hash::make($this->new_password)
            ]);
            session()->flash('status'," your password changed");
            $this->new_password='';
            $this->old_password='';
            $this->confirm_pass='';
        }

            // return with("status", "Password changed successfully!");
    }
}
