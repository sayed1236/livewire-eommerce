<?php

namespace Modules\Trader\Livewire\Search;

use Livewire\Component;
use App\Models\Company;


class Searchvendor extends Component
{
    public $searchvalue='',$category,$show,$orderby='asc';
    public function mount($param1,$param2){
        $this->category = $param1;
        $this->searchvalue = $param2;
    }
    public function render()
    {
        $vendors = [];
         if ($this->category == 'vendors') {
            $vendors = Company::with('companygallery')->where('name', 'like', '%' . $this->searchvalue . '%')->limit(6)->get();
        } 
        return view('trader::livewire.search.searchvendor',compact('vendors'))->extends('trader::components.layouts.app');
    }
}
