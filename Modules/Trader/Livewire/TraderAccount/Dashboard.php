<?php

namespace Modules\Trader\Livewire\TraderAccount;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Trader\Trader;
class Dashboard extends Component
{
    public $is_photo,$productsfororder,$dashboard=true,$orders=false,$downloads=false,$order=false,$addresses=false,$details=false,$socials=false;
    public function render()
    {
        $orderproducts = Order::with('orderproducts')->where('trader_id',@auth('trader')->user()->id)->get();

        $this->is_photo = Trader::find(@auth()->guard('trader')->user()->id);
        return view('trader::livewire.trader-account.dashboard',compact('orderproducts'))->extends('trader::components.layouts.app');
    }
    public function logout()
    {
        Auth::guard('trader')->logout();
        return redirect('/');
    }
   public function show_dashboard()
    {
        $this->dashboard=true;
        $this->orders=false;
        $this->order=false;

        $this->downloads=false;
        $this->addresses=false;
        $this->details=false;
        $this->socials=false;
    }
    public function show_orders()
    { 
        $this->orders=true;
        $this->downloads=false;
        $this->dashboard=false;

        $this->addresses=false;
        $this->details=false;
        $this->socials=false;
        $this->order=false;

    }
    public function show_downloads()
    {
        $this->dashboard=false;
        $this->orders=false;
        $this->downloads=true;
        $this->addresses=false;
        $this->details=false;
        $this->socials=false;
        $this->order=false;

    }
    public function show_addresses()
    {
        $this->dashboard=false;
        $this->orders=false;
        $this->downloads=false;
        $this->addresses=true;
        $this->details=false;
        $this->socials=false;
        $this->order=false;

    }
    public function show_details()
    {
        $this->dashboard=false;
        $this->orders=false;
        $this->downloads=false;
        $this->addresses=false;
        $this->details=true;
        $this->socials=false;
        $this->order=false;

    }
    public function show_order($id)
    {
        

        return redirect()->route('trader.vieworder', $id);


    }
    public function show_track($id)
    {
        

        return redirect()->route('trader.track', $id);


    }
   
}
