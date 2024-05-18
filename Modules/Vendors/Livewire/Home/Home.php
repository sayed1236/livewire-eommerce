<?php

namespace Modules\Vendors\Livewire\Home;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('vendors::livewire.home.home')->extends('vendors::components.layouts.app');
    }
}
