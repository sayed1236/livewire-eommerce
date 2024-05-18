<?php

namespace Modules\Trader\Livewire\Compare;
use App\Models\Product;
use App\Models\Category;
use App\Models\Trader_History_Log;
use App\Models\TraderOrder;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\TraderFavorite;

class Compare extends Component
{
    public $cat_attributes;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
       


        $comparisonList = json_decode(request()->cookie('comparisonList', '[]'), true);

        $products = Product::with([
                'attributes' => function ($q) {
                    $q->with('main_attribute', 'attribute_values');
                },
                'products_rates',
                'discounts_product',
                'latestProductStock.stock'
            ])
            ->whereIn('id', $comparisonList)
            ->get();
        
        $main_category = null;
        
        // Check if $products is not empty before accessing its elements
        if (!$products->isEmpty()) {
            $main_category = getMainCategory($products[0]->category);
        }
        
        // Now you can use $main_category safely
        
    // dd($main_category->id);
    if ($main_category !== null) {
        // Now it's safe to access the id property
        $this->cat_attributes = Category::with(['attributes' => function ($q) {
            $q->with(['attribute_values' => function ($q) {
                $q->where('parent_id', 0);
            }])->where('parent_id', 0);
        }])->find($main_category->id);
    
    } else {
        // Handle the case when $main_category is null
        // This might involve logging an error, redirecting, or other appropriate actions
    }

    //  dd($cat_attributes->attributes);
        return view('trader::livewire.compare.compare',compact('products'))->extends('trader::components.layouts.app');
    }
    public function removeFromCompare($id)
    {
        $comparisonList = json_decode(request()->cookie('comparisonList', '[]'), true);
    
        // Check if the array key exists for the given $id before attempting to unset it
        if (($key = array_search($id, $comparisonList)) !== false && isset($comparisonList[$key])) {
            unset($comparisonList[$key]);
            cookie()->queue('comparisonList', json_encode($comparisonList), 1440);
        }
    
        $this->dispatch('refreshComponent');
    }
    
    public function add_to_wishlist($id){
        if(auth()->guard('trader')->check()){
            if(TraderFavorite::where('trader_id',auth()->guard('trader')->user()->id)->where('favo_id',$id)->exists()){
                TraderFavorite::where('favo_id',$id)->delete();
            }
            else{
                $tradfav = new TraderFavorite();           
                $tradfav->trader_id=auth()->guard('trader')->user()->id;
                $tradfav->favo_id=$id;
                $tradfav->save();  
            }
        }else{
           return redirect()->route('trader.loginastrader');
        }
    }
    public function add_cart($id)
    {
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
        $data->quantity=1;
        $data->total_price += $data->quantity * $product->latestProductStock->selling_price;
       $data->save();
       }else{
        $order->quantity++;
        $order->total_price = $order->quantity * $product->latestProductStock->selling_price;
        $order->save();
       }
       //    $this->dispatch('get_modal_side');
       $this->dispatch('refreshComponent');

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
}
