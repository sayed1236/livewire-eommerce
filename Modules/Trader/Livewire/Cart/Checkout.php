<?php

namespace Modules\Trader\Livewire\Cart;
use App\Models\TraderOrder;
use App\Models\Order;
use App\Models\CountriesCity;
use App\Models\OrdersProduct;
use App\Models\OrderAddress;
use App\Models\Trader\Trader;
use App\Models\Coupon;

use App\Models\CouponsUsesUser;

use Livewire\Component;

class Checkout extends Component
{
    public $trader,$coupon_discount_id,$data,$coupon_discount,$error_coupon,$coupon,$trader_orders,$totalcart,$email,$mobile,$state,$states,$country_id,$address,$title,$countries,$postal_code,$street,$city,$notes;

    public function mount(){
        @$this->email = auth('trader')->user()->email;
        @$this->mobile = auth('trader')->user()->mobile;
        @$this->address = auth('trader')->user()->address;
        @$this->street = auth('trader')->user()->street;
        @$this->notes = auth('trader')->user()->notes;
        @$this->country_id = auth('trader')->user()->country;

    }

    public function render()
    {
        // dd($this->country_id);
        $countricities=CountriesCity::select('id','name','parent_id')->get();
        $this->states=null;
        $this->countries=null;

        if(count($countricities)){
            $this->countries=$countricities->where('parent_id',0);
            if ($this->country_id !== null) {
                $this->states=$countricities->where('parent_id',$this->country_id);
            }
            
        }
        $this->trader = Trader::find(@auth('trader')->user()->id);
       
        // dd($this->trader->email);
        if (auth('trader')->check()) {
            $this->trader_orders = TraderOrder::with('product')
                ->where('trader_id', auth('trader')->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_ip', \Request::ip())
                          ->where('user_pc_info', \Request::header('User-Agent'));
                })
                ->get();
        } else {
            $this->trader_orders = TraderOrder::with('product')
                ->where(['user_ip' => \Request::ip(), 'user_pc_info' => \Request::header('User-Agent')])
                ->get(); 
        }
        $this->data=Order::where('trader_id',@auth('trader')->user()->id)->where(['status'=>'new'])->first();
        return view('trader::livewire.cart.checkout')->extends('trader::components.layouts.app');
    }
    public function save(){
        $countricities=CountriesCity::select('name')->find($this->country_id);
        // dd($countricities->name);
            $validated = $this->validate([ 
                'email' => 'required|email',
                'postal_code' => 'required|string',
                'state' => 'required',

                'mobile' => 'required|string',
                'address' => 'required|string',
                'street' => 'required|string',
               

            ]);
            // dd($this->trader_orders->product);
            // $order=Coupon::where('trader_id',auth()->user()->id)->where('status','new')->first();

            // if(!$order){
                $order = new Order();
                $order->status = 'new';
                $order->trader_id = auth('trader')->user()->id;
                
                // if ($this->coupon_discount !== null) {
                    $chk_coupon = Coupon::where(['coupon_code' => $this->coupon, 'is_active' => 'Y'])->first();
                
                    if ($chk_coupon) {
                        $order->coupon_id = $chk_coupon->id;
                        $order->coupon_discount = $chk_coupon->coupon_discount;
                
                        $this->error_coupon = 'The coupon has been saved successfully.';
                        // $this->coupon_discount = $chk_coupon->amount;
                    }elseif($this->coupon_discount!==null){
                        $order->coupon_id = $this->coupon_discount_id;
                        $order->coupon_discount = $this->coupon_discount;
                        $this->error_coupon = 'The coupon has been saved successfully.';
                    }else{
                        $this->error_coupon='The coupon wrong.';
    
                    }
                
                    $this->coupon = '';
                // }  
                $order->save();
    
                foreach ($this->trader_orders as $total) {
                    if(@$total->product->min_amount_to_buy <=
                    @$total->quantity ){
                    if(@$total->product->latestProductStock->quantity <=
                                        $total->quantity ){
    
                                        }
                    else{
    
                                      
                    // dd($total->product->discounts_product->quantity_from);
                    $orderproduct = new OrdersProduct();
                    // $orderproduct->order_id = $total->product_id;
    
                    $orderproduct->product_id = $total->product_id;
                    $orderproduct->order_id = $order->id;
                    $orderproduct->vendor_id = $total->product->company_id;
                    $orderproduct->stock_id = $total->product->latestProductStock->stock_id;
                    if(@$total->product->discounts_product->quantity_from <= @$total->quantity && @$total->quantity<= @$total->product->discounts_product->quantity_to){
                        $orderproduct->discount = $total->product->discounts_product->discount_percent;
                    }              
                
                    $orderproduct->quantity = $total->quantity;
                
                    $orderproduct->save();
                    $this->totalcart += @$total->total_price;
                }}
                }
               
                $address = new OrderAddress();
                $address->order_id = $order->id;
                $address->email  = $this->email;
                $address->mobile  = $this->mobile;
                $address->notes  = $this->notes;
                $address->country  = $countricities->name;
                $address->state  = $this->state;
    
                $address->address = $this->address;
                $address->street = $this->street;
                $address->postal_code = $this->postal_code;
    
                // Save the order after the loop
                $address->save();
                
                $order->order_total_price = $this->totalcart;
                $order->save();
              $this->comcheckout = 'the order added successfully';        
           
        return redirect()->route('home');
        


    }
    public function discountcoupon(){
        // dd('kj');
       $this->validate([ 
            'coupon' => 'required',
            
        ]);
        $chk_coupon=Coupon::where(['coupon_code'=>$this->coupon,'is_active'=>'Y'])->first();
        if(is_null($chk_coupon) == 0)
        {
            $this->coupon_discount_id=$chk_coupon->id;

            $this->coupon_discount=$chk_coupon->amount;
            
            $this->error_coupon='The coupon has been saved successfully.';
            $this->error_coupon=null;
           
        }
        else
        {
            $this->error_coupon='Sorry, there is no coupon for this information';
            $this->error_coupon=null;

        }
        $this->coupon = '';
    }
    public function delete_coupon(){
        $data=Order::where('trader_id',@auth('trader')->user()->id)->where(['status'=>'new','is_done'=>'N'])->first();
        if(is_null($data) == 0)
        {
            $data->coupon_id=0;
            $data->coupon_discount=0;
            $data->save();
          
        }
    }
}
