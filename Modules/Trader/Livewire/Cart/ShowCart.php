<?php

namespace Modules\Trader\Livewire\Cart;
use Cart;
use Darryldecode\Cart\CartCondition;
use App\Models\Product;
use Livewire\Component;
use App\Models\ProductStockDiscount;
use App\Models\Trader_History_Log;


class ShowCart extends Component
{
    
    public $quantity=[],$carts,$show_amount=false,$coupon,$value=[];
    protected $listeners = ['refreshComponent' => '$refresh'];

    // public function mount()
    // {
    //     // Initialize the cart and quantity data (load from a database, for example)
    //     // ...

    //     // Check if the $quantity property is empty and set default values if needed
        
    //         $this->quantity[0] = 1;
      
    // }
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
    public function render()
    {
        $product = ProductStockDiscount::where(['product_id' => 7, 'stock_id' => 1])->first();
        // dd($product->quantity_from);
        
    //    dd($this->quant);
        $this->carts= Cart::getContent();
        // dd($this->carts);
       
        return view('trader::livewire.cart.show-cart')->extends('trader::components.layouts.app');
    }
    public function increase($id){
        // dd('sdm');
        $this->quantity[$id]++;
        }
    public function clear_cart(){
        Cart::clear();
    }
    
    public function delete_prod($id)
    {
        
        Cart::remove($id);

    }
    public function check_amount(){

        $this->show_amount=true;
    }
    public function addcoupon(){
        $this->validate([
            'coupon' => 'required|min:6',

        ]);
        // dd('ksj');
    }
    public function update_cart(){
        
        $carts = Cart::getcontent();
    $keys = array_keys($this->quantity);

    foreach ($keys as $key) {
        $this->value[] = $this->quantity[$key];
        
    }
    foreach(Cart::getContent() as $cart){
        foreach($keys as $key){
            if($cart->id == $key){
                Cart::update($key,array(
                    'quantity' => array(
                                'relative' => false,
                                'value' => $this->quantity[$key]
                    )
                ));
            }
        }
        // if($cart->)
    }
    // dd($keys);
    

    // Cart::update($id, array(
    //     'quantity' => array(
    //         'relative' => false,
    //         'value' => $this->quantity
    //     ),
    // ));
                //    
       
        
                // dd($id);
        // if($id){
        //     $cart = Cart::update($id, array(
        //         'quantity' => array(
        //             'relative' => false,
        //             'value' => $this->quantity[$id]
        //         ),
        //       ));
        // }
       
        
        // unset($this->quantity); 
        // $quantity = [$cart];
        // array_splice($this->quantity, 0);
       
        // dd($this->quantity);
       
        //   $this->dispatch('refreshComponent');

    }
}
