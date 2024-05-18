<?php

namespace Modules\Vendors\Livewire\Auth;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component


{
    public $mobile,$email,$email1,$password,$password1,$first_name,$shop_name,$shop_url,$is_sign_up=false,$is_sign_in,$sign_in_active,$sign_up_active ,$remember_me,
    $name,$last_name,$user_name,$address,$password_confirmation,$privacy_policy;

    public function mount()
    {
        // $is_sign_up=true;
        $this->sign_up_active="active";
        $this->sign_in_active="";
    }

        public function render()
        {
            // session()->flash('error','عفوا البيانات خطأ');

            return view('vendors::livewire.auth.login')->extends('vendors::components.layouts.app');
        }
        public function change_view_to_signin ()
        {
                // $this->is_sign_in=true;
                $this->is_sign_up=false;

                // $this->sign_up_active="active";
                // $this->sign_in_active="";
                // dd( $this->sign_in_active);
        }
        public function change_view_to_signup ()
        {
            $this->is_sign_up=true;
                // $this->is_sign_in=false;
                // $this->sign_up_active="active";
                // $this->sign_in_active="";
                // dd( $this->sign_up_active);


        }

        public function login()
        {
            if($this->remember_me){

                $this->remember_me=true;

            }else{
                $this->remember_me=false;

            }

            $this->validate([

                'email'   => 'required',
                'password' => 'required'
            ]);

                if (Auth::guard('companies')->attempt(['email' => $this->email , 'password' => $this->password],$this->remember_me)) {
                    return redirect()->intended('/vendors/myaccount');
                  }

                elseif (Auth::guard('companies')->attempt(['mobile' => $this->email , 'password' => $this->password])) {
                    return redirect()->intended('/vendors/myaccount');
                    }

                else{
                    // Session::flash('flash_message','successfully saved.');
                    session()->flash('error',' email or phone is incorrect');
                    // dd( session()->flash('error'));
                }
        }
        public function register()
        {
            $this->validate([
                'name'=>'required|string',
                // 'last_name'=>'required|string|min:2|max:50',
                // 'shop_name'=>'required|string|min:2|max:50',
                // 'shop_url'=>'required|string|min:10|max:500',
                'mobile'=>'required|unique:companies,mobile',
                'email1'=>'required|email|unique:companies,email',
                // 'privacy_policy'=>'required',
                // 'user_name'=>'required',
                'password1'=>['required',
                // 'confirmed',
                'min:6'
                          ,'regex:/[a-z]/',
                          'regex:/[0-9]/',

            ],
                // 'password_confirmation' => 'required|min:6'
            ]);
            // dd($this->validate);
            if ($this->privacy_policy== true) {
                $data=new Company();
                $data->name=$this->name;
                // $data->last_name=$this->last_name;
                // $data->shop_name=$this->shop_name;
                // $data->shop_url=$this->shop_url;
                // $data->user_name=$this->user_name;
                $data->mobile=$this->mobile;
                $data->email=$this->email1;
                $data->password= Hash::make($this->password1);
                $data->save();

                session()->flash('success_message',' succes registering ');
                $this->resetPassword();
                return redirect('vendors/login');            }
            else {
                session()->flash('privacy_policy','  you must first accept privacy policy ');
            }

        }
         public function resetPassword()
        {
            $this->name=null;
            $this->last_name=null;
            $this->user_name=null;
            $this->mobile=null;
            $this->email=null;
            $this->password=null;
            $this->address=null;
            $this->password_confirmation=null;
        }

}
