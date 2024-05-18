<?php

namespace Modules\Trader\Livewire\About;

use App\Models\StaticPage;
use Livewire\Component;

class About extends Component
{
    public $slug ,$result;
    function mount($slug='about') 
    {
        $this->slug=$slug;
        
    }
    public function render()
    {
        $this->result = StaticPage::where(['is_active'=>'Y','slug'=>$this->slug])->first();
        if(is_null($this->result)==1)
        {
            return abort('404');
        }
        // dd($this->result);
        return view('trader::livewire.About.about')->extends('trader::components.layouts.app');
    }
}
