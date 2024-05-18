<?php

namespace Modules\Trader\Livewire\Products;
use App\Models\Product;
use App\Models\Category;
use App\Models\TraderFavorite;
use DB;
use App\Models\Attributescategory;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Productsrate;
use Livewire\Component;
use App\Models\TraderOrder;

use App\Models\Trader_History_Log;
use App\Models\Companycontactus;
class Products extends Component
{
    public $product_id,$show_mesage,$price=false,$quantity=1,$rating,$message,$show_all=true,$positive_repl=false,$negative_repl=false,
    $highest_repl=false,$lowest_repl=false;
    public function mount($product_id=0)
    {
        
        $this->product_id=$product_id;
    }
    public function render()
    { 
        $popular_top=[];
        $product = Product::with([
            
            'atts_cats',
            'prouct_price',
            'products_gallaries' => function ($query) {
                $query->select('product_id', 'path')->limit(10);
            },
            'latestProductStock',
        
        ])
        ->where('is_active', 'Y')
        ->find($this->product_id);
        // dd($product);
        $more_products=Product::with('trader_history_logs','products_rates','latestProductStock')->select('id','name','img')->where('is_active','Y')->take(6)->get();
        $vendor_products = Product::where('company_id', $product->company_id)
        ->where('id', '!=', $product->id) 
        ->with('trader_history_logs', 'products_rates', 'latestProductStock','products_gallaries')
        ->select('id', 'name', 'img')
        ->where('is_active', 'Y')
        ->latest('created_at')->take(6)->get();
        // dd($vendor_products);

    $product_popularity=Product::where('category_id',$product->category_id) ->where('id', '!=', $product->id) ->with('trader_history_logs','products_rates','latestProductStock')->select('id','name','img')->where('is_active','Y')->take(2)->get();
    // dd($product_popularity);
        return view('trader::livewire.products.products',compact('product','product_popularity','more_products','vendor_products'))->extends('trader::components.layouts.app');
    }
    public function vendorproducts($vendor_id){
        return redirect()->route('trader.shop', $vendor_id);

    }
  
    public function plus(){
        $this->quantity++;
    }
    public function minus(){
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function show_modal($id){
        // dd($this->the_modal);
        $this->dispatch('modal',$id);
    }
    public function savemsg(){
        
        $vendor = Product::find($this->product_id);
        if(auth('trader')->check()){
            $this->validate([
                'message'=>'required|min:7'
            ]);
            $message_from_trader = new Companycontactus();
            $message_from_trader->company_id = $vendor->vendor->id;
            $message_from_trader->user_id = auth('trader')->user()->id;
            $message_from_trader->message = $this->message;
            $message_from_trader->save();
            $this->show_mesage="the message sent successfully";


        }else{
            return redirect()->route('trader.loginastrader');

        }
        $this->message='';
    }
    public function show_category($category_id){
        // dd($category_id);
        return redirect()->route('trader.category', $category_id);

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

    public function add_to_wishlist(){
        // dd($id);
    if(auth()->guard('trader')->check()){
        if(TraderFavorite::where('trader_id',auth()->guard('trader')->user()->id)->where('favo_id',$this->product_id)->exists()){
            TraderFavorite::where('favo_id',$this->product_id)->delete();
        }
        else{
            $tradfav = new TraderFavorite();           
            $tradfav->trader_id=auth()->guard('trader')->user()->id;
            $tradfav->favo_id=$this->product_id;
            $tradfav->save();  
        }
    }else{
       return redirect()->route('trader.loginastrader');
    }
          
    }
    public function add_cart()
        {
            $this->validate([
                'quantity' =>'required'
            ]);
            $id = $this->product_id;
            $order = TraderOrder::where(function ($query) use ($id) {
                $query->where('trader_id', @auth('trader')->user()->id)
                    ->where('product_id', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('user_ip', \Request::ip())
                    ->where('user_pc_info', \Request::header('User-Agent'))
                    ->where('product_id', $id);
            })
            ->first();
            // dd(empty($order));
            $product=Product::with('latestProductStock')->select('id','name','img')->where('is_active','Y')->find($id);
        if (empty($order)) {
                // dd('hi');
        $data=new TraderOrder();
           
        if (auth('trader')->check()) {
            $data->trader_id=auth('trader')->user()->id;
        }else{
            $data->user_ip=\Request::ip();
            $data->user_pc_info=\Request::header('User-Agent');
        }
        $data->product_id = $id;
        $data->quantity=$this->quantity;
        $data->total_price += $data->quantity * $product->latestProductStock->selling_price;
       $data->save();
       }else{
        $order->quantity = $this->quantity;
        $order->total_price = $order->quantity * $product->latestProductStock->selling_price;
        $order->save();
       }
       $this->quantity = 1;
    //    $this->dispatch('get_modal_side');

                      $this->dispatch('refreshComponent');

        }
        public function add_to_compare($id){
            $product = Product::find($id);
        $comparisonList = json_decode(request()->cookie('comparisonList', '[]'), true);
        // dd($comparisonList[0]);
            if (empty($comparisonList)) {
                
               
                if ($product) {
                    $comparisonList = [$id];
                }
                cookie()->queue('comparisonList', json_encode($comparisonList), 1440); // 1440 minutes (1 day)
    
            } else {
                $product = Product::find($id);
               $firstproduct = Product::find($comparisonList[0]);
               $firstmaincategory = getMainCategory($firstproduct->category);
               $anothermaincategory = getMainCategory($product->category);
    
                if ($product && $firstmaincategory->id  === $anothermaincategory->id) {
                    if (!in_array($id, $comparisonList) ) {
                        $comparisonList[] = $id;
                        cookie()->queue('comparisonList', json_encode($comparisonList), 1440); // 1440 minutes (1 day)
                    }
                    
                } else {
                    // cookie()->queue(Cookie::forget('comparisonList'));
    
                    $comparisonList = [$id];
                    cookie()->queue('comparisonList', json_encode($comparisonList), 1440); // 1440 minutes (1 day)
    
                }
            }
            
            
    //    
    }
     

       
    public function showprice(){

        $this->price = true;
    }
}
