<?php

namespace Modules\Vendors\Livewire\Orders;

use App\Models\Order;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrders extends Component
{
    public $orders,$myorders;
    public function render()
    {
        $this->orders=OrdersProduct::select('order_id','vendor_id')->where('vendor_id',Auth::guard('companies')->user()->id)->groupBy('order_id')->get();
        // $this->orders=OrdersProduct::select('order_id','vendor_id')->where('vendor_id',1)->groupBy('order_id')->get();
        $i=0;
        if ($this->orders) {
            foreach ($this->orders as $order_id) {
                $i++;
                $this->myorders[$i]=Order::find($order_id->order_id);
                }
        }


        // dd($this->myorders);

        return view('vendors::livewire.orders.my-orders')->extends('vendors::components.layouts.app');
    }
}
