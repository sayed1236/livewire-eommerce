<?php

namespace Modules\Trader\Livewire\TraderAccount;

use Livewire\Component;
use App\Models\Trader\Trader;
class Addresses extends Component
{
    public $name,$email,$country,$state,$address,$mobile;
    public $edit=true;
    public function mount(){
        @$this->email = auth('trader')->user()->email;
        @$this->mobile = auth('trader')->user()->mobile;
        @$this->address = auth('trader')->user()->address;
        @$this->name = auth('trader')->user()->name;
        @$this->country = auth('trader')->user()->country;
        @$this->state = auth('trader')->user()->state;
  
    }
    public function render()
    {
        return view('trader::livewire.trader-account.addresses');
    }
    public function add_address(){
        $this->edit=false;
    }
    public function save(){
        // $this->validate([
        //  'name'=>'required',
        //  'email'=>'required',
        //  'mobile'=>'required',
        //  'country'=>'required',
        //  'state'=>'required',
        //  'address'=>'required',
        // ]);
        $trader = Trader::find(auth('trader')->user()->id);
        $trader->name=$this->name;
        $trader->mobile=$this->mobile;
        $trader->country=$this->country;
        $trader->state=$this->state;
        $trader->address=$this->address;

        $trader->email=$this->email;
        $trader->save();
        $this->edit=true;

    }
}
