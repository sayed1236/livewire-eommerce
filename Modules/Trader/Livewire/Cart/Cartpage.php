<?php

namespace Modules\Trader\Livewire\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\TraderOrder;
use App\Models\Order;
use App\Models\Trader_History_Log;

use App\Models\CountriesCity;
use App\Models\OrdersProduct;
use App\Models\OrderAddress;
use App\Models\Trader\Trader;
use App\Models\Coupon;

use App\Models\CouponsUsesUser;

use Livewire\Component;

class Cartpage extends Component
{
    public $quant,$count_new,$cart=true,$checkout=false,$payment=false,$finish=false;
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
        if (auth('trader')->check()) {
          $trader_orders = TraderOrder::with('product')
              ->where('trader_id', auth('trader')->user()->id)
              ->orWhere(function ($query) {
                  $query->where('user_ip', \Request::ip())
                        ->where('user_pc_info', \Request::header('User-Agent'));
              })
              ->get();
      } else {
          $trader_orders = TraderOrder::with('product')
              ->where(['user_ip' => \Request::ip(), 'user_pc_info' => \Request::header('User-Agent')])
              ->get(); 
      }
        // dd($trader_orders);
        return view('trader::livewire.cart.cartpage',compact('trader_orders'))->extends('trader::components.layouts.app');
    }
    public function add_count($id){
        // dd($this->count_new);
        // dd('hi');
        $order=TraderOrder::with(['product'])->find($id);
        // dd($order);
        if($order != null){
            $order->quantity = $this->count_new;
          $order->total_price = floatval($this->count_new) * floatval($order->product->latestProductStock->selling_price);
        //   dd($order->total_price);
          if($order->total_price>0){
            $order->save();

          }
        }
    }
    public function delete_prod($id){
        if($id){
            TraderOrder::find($id)->delete();
        }
        $this->dispatch('refreshComponent');

    }
    public function clear_cart(){
        $myorders = TraderOrder::where('trader_id',@auth('trader')->user()->id)->
            orWhere(['user_ip'=>\Request::ip(),'user_pc_info'=>\Request::header('User-Agent')])->get();
           if($myorders != null){
            foreach ($myorders as $myorder) {
                $myorder->delete();
            }

           }
    }
    public function plus($id){
        $order=TraderOrder::with('product')->find($id);
        if($order != null){
            $order->quantity++;
          $order->total_price = floatval($order->quantity) * floatval($order->product->latestProductStock->selling_price);
        //   dd($order->total_price);
          if($order->total_price>0){
            $order->save();

          }

    }
}
    public function minus($id){
        $order=TraderOrder::with('product')->find($id);
        if($order != null && $order->quantity>0){
            $order->quantity--;
          $order->total_price = floatval($order->quantity) * floatval($order->product->latestProductStock->selling_price);
        //   dd($order->total_price);
          if($order->total_price>0){
            $order->save();

          }

    }
}
public function showproduct($id){

  $num_of_views=1;
  if(auth()->guard('trader')->check()){
      if(Trader_History_Log::where('trader_id',auth()->guard('trader')->user()->id)->where('product_id',$id)->exists()){
          $views_Repetition = Trader_History_Log::where('product_id',$id)->where('trader_id',auth()->guard('trader')->user()->id)->first(); 
          // dd($views_Repetition);
          $views_Repetition->num_views++;
          $views_Repetition->save();
  
        
      }
      else{
          $views = new Trader_History_Log();           
          $views->trader_id=auth()->guard('trader')->user()->id;
          $views->product_id=$id;
          $views->num_views = $num_of_views;
          $views->save();  
      }
  }else{
     if(Trader_History_Log::where('user_ip',\Request::ip())->where('product_id',$id)->exists()){
      // dd('yes');
          $views_Repetition = Trader_History_Log::where('product_id',$id)->where('user_ip',\Request::ip())->first(); 
          // dd($views_Repetition);
          $views_Repetition->num_views++;
          $views_Repetition->save();
  
        
      }
      else{
          // dd('no');

          $views = new Trader_History_Log();           
          $views->user_ip=\Request::ip();
          $views->product_id=$id;
          $views->user_pc_info=\Request::header('User-Agent');

          $views->num_views = $num_of_views;
          $views->save();  
      }

}
return redirect()->route('trader.product', $id);
}
    public function show_cart()
    {
      $this->cart=true;

        $this->checkout=false;
        $this->payment=false;
        $this->finish=false;
      
    }
    public function show_checkout()
    {
      
      if(auth('trader')->check()){
        $this->cart=false;

        $this->checkout=true;
        $this->payment=false;
        $this->finish=false;
      }else{
        return redirect()->route('trader.loginastrader');
      }
      
    }
    public function show_payment()
    {
      $validated = $this->validate([ 
        'email' => 'required|email',
        'postal_code' => 'required|string',
        'state' => 'required',

        'mobile' => 'required|string',
        'address' => 'required|string',
        'street' => 'required|string',
       

    ]);
      if(auth('trader')->check()){
       $this->cart=false;

        $this->checkout=false;
        $this->payment=true;
        $this->finish=false;
      }else{
        return redirect()->route('trader.loginastrader');
      }
      
      
    }
    public function show_finish()
    {
      if(auth('trader')->check()){
        $this->cart=false;

        $this->checkout=false;
        $this->payment=false;
        $this->finish=true;
      }else{
        return redirect()->route('trader.loginastrader');
      }
     
      
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
                      // $order->coupon_id = $this->coupon_discount_id;
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
            $myorders = TraderOrder::where('trader_id',@auth('trader')->user()->id)->
            orWhere(['user_ip'=>\Request::ip(),'user_pc_info'=>\Request::header('User-Agent')])->get();
           if($myorders != null){
            foreach ($myorders as $myorder) {
                $myorder->delete();
            }

           }
            $this->cart=false;

            $this->checkout=false;
            $this->payment=false;
            $this->finish=true;
      


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
    $this->coupon_discount=null;
  }
}
