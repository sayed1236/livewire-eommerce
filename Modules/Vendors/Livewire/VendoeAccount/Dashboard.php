<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Dashboard extends Component
{
   public $user,$id ,$name, $img, $mobile, $email;
    public function render()
    {
        if ( $this->user=Auth::guard('companies')->user()) {
            $this->user=Auth::guard('companies')->user();
            $this->id= $this->user->id;

            $this->name= $this->user->name;
            $this->mobile= $this->user->mobile;
            $this->email= $this->user->email;
            // dd($this->email);
            }

        return view('vendors::livewire.vendoe-account.dashboard')->extends('vendors::components.layouts.app');
    }
    public function logout()
    {

        Auth::guard('companies')->logout();

        return redirect('vendors/login');
    }


}
