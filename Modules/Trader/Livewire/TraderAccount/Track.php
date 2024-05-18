<?php

namespace Modules\Trader\Livewire\TraderAccount;

use Livewire\Component;
use App\Models\Order;

class Track extends Component
{
    public $track;
    public function mount($id){

        $this->track = Order::with('orderproducts','address')->find($id);
    }
    public function render()
    {
        return view('trader::livewire.trader-account.track')->extends('trader::components.layouts.app');
    }
}
