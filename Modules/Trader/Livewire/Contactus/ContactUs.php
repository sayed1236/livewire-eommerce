<?php

namespace Modules\Trader\Livewire\Contactus;

use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        return view('trader::livewire.contactus.contact-us')->extends('trader::components.layouts.app');
    }
}
