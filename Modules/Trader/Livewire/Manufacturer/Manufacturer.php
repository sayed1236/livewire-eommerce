<?php

namespace Modules\Trader\Livewire\Manufacturer;

use Livewire\Component;

class Manufacturer extends Component
{
    public function render()
    {
        return view('trader::livewire.manufacturer.manufacturer')->extends('trader::components.layouts.app');
    }
}
