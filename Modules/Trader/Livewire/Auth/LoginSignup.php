<?php

namespace Modules\Trader\Livewire\Auth;
use Illuminate\Support\Facades\Auth;

use App\Models\Trader\Trader;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Session;

use Livewire\Component;

class LoginSignup extends Component
{
    public $sign_in=true,$remember_me;
    public $passwordlogin,$username;
    #[Rule('required|min:3')] 
    public $name = '';
 
    #[Rule('required|email|unique:traders|min:7|max:40')] 
    public $email = '';
    #[Rule('required|confirmed|regex:/^(?=.*[A-Za-z])(?=.*[1-9])[A-Za-z\d@$!%*?&]{8,}$/')] 
    public $password = '';   
    #[Rule('required|min:3')] 
    public $password_confirmation = '';  

     #[Rule('required|min:7|max:25|unique:traders')] 
    public $mobile = ''; 
    #[Rule('required')] 
    public $remember = '';  

  
    // 'regex:/[a-z]/regex:/[0-9]/'


    public function render()
    {
        return view('trader::livewire.auth.login-signup')->extends('trader::components.layouts.app');
    }
    public function login()
    {
        // dd('lemc');
        if($this->remember_me){
           
            $this->remember_me=true;
           
        }else{
            $this->remember_me=false;
           
        }

        if (Auth::guard('trader')->attempt(['email' => $this->username, 'password' => $this->passwordlogin], $this->remember_me) ||
           Auth::guard('trader')->attempt(['mobile' => $this->username, 'password' => $this->passwordlogin], $this->remember_me)) {
           return redirect()->to('/');
        } else {
           Session::flash('error', 'Error in password or email...!');
       }
     }
    public function register()
    {
        // dd('df,');
        $this->validate();


        $trader = new Trader();
        $trader->name = $this->name;
        $trader->email = $this->email;
        $trader->password = bcrypt($this->password);
        $trader->mobile = $this->mobile;

        $trader->save();
        session()->flash('success','تم التسجيل بنجاح');
        $this->resetPassword();
        $this->sign_in=true;
    }
    public function resetPassword()
    {
        $this->name=null;
        $this->last_name=null;
        $this->mobile=null;
        $this->email=null;
        $this->password=null;
        $this->address=null;
    }
    public function active_login(){
        $this->sign_in=true;
    }
    public function active_signup(){
        $this->sign_in=false;
    }
}
