<?php

namespace Modules\Trader\Livewire\Cart;

use Livewire\Component;

class CompleteOrder extends Component
{
    public function render()
    {
        return view('trader::livewire.cart.complete-order')->extends('trader::components.layouts.app');
    }
}
