<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addresses extends Component
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
        return view('vendors::livewire.vendoe-account.addresses');
    }
}
