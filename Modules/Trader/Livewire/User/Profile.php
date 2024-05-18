<?php

namespace Modules\Trader\Livewire\User;
use App\Models\trader\trader;
use Livewire\Component;

class Profile extends Component
{
    public $show=true,$address;
    public function render()
    {
        return view('trader::livewire.user.profile')->extends('trader::components.layouts.app');
    }
    public function edit()
    {
        $this->show=false;
    }
    public function edit_address(){
        // dd($this->address);
      if($this->address){
        $id = auth()->guard('trader')->user()->id;
        $trader=Trader::findOrFail($id);
        
        $trader->address=$this->address;
        $trader->save();
      }
      $this->show=true;

      
    }
}
