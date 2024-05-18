<?php

namespace Modules\Vendors\Livewire\Auth;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{


    public $name,$last_name,$mobile,$email,$password,$password_confirmation,$address,$user_name;



        public function render()
        {
            return view('vendors::livewire.auth.register')->extends('vendors::components.layouts.app');
        }
        public function register()
        {
            $this->validate([
                'name'=>'required|string',
                'last_name'=>'required|string|min:2|max:50',
                'shop_name'=>'required|string|min:2|max:50',
                // 'mobile'=>'required|unique:Company,mobile',
                'email'=>'required|email|unique:Company,email',
                // 'address'=>'required',
                // 'user_name'=>'required',
                'password'=>['required','confirmed','min:6'
                          ,'regex:/[a-z]/',
                          'regex:/[0-9]/',

            ],
                'password_confirmation' => 'required|min:6'
            ]);
            $data=new Company();
            $data->name=$this->name;
            $data->last_name=$this->last_name;
            $data->user_name=$this->user_name;
            $data->mobile=$this->mobile;
            $data->email=$this->email;
            $data->password= Hash::make($this->password);
            $data->address=$this->address;
            $data->role_id=1;
            $data->save();

            session()->flash('success_message','تم التسجيل بنجاح');
            $this->resetPassword();
            return redirect()->route('login-home');
        }
        // public function resetPassword()
        // {
        //     $this->name=null;
        //     $this->last_name=null;
        //     $this->user_name=null;
        //     $this->mobile=null;
        //     $this->email=null;
        //     $this->password=null;
        //     $this->address=null;
        //     $this->password_confirmation=null;
        // }

}
