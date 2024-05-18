<?php

namespace Modules\Vendors\Livewire\Orders;

use App\Models\OrdersProduct;
use Livewire\Component;

class Orderdetails extends Component
{
    public $order_products1,$order_products2,$order_id,$adreess;
    public function mount()
    {
        $this->order_id=request("id");
    }
    public function render()
    {
        // dd(request("id"));
$this->order_products1=OrdersProduct::where('order_id',$this->order_id)->with('order')->first();
// dd($this->order_products1->order);
$this->order_products2=OrdersProduct::where('order_id',$this->order_id)->with('order','product')->get();
$this->adreess=$this->order_products1->order->order_address;


        return view('vendors::livewire.orders.orderdetails')->extends('vendors::components.layouts.app');
    }
}
