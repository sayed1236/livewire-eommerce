<?php

namespace Modules\Trader\Livewire\Freelancers;

use Livewire\Component;

class Freelancer extends Component
{
    public function render()
    {
        return view('trader::livewire.freelancers.freelancer')->extends('trader::components.layouts.app');
    }
}
