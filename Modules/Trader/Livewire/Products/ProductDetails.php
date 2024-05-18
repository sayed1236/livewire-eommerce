<?php

namespace Modules\Trader\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\TraderFavorite;
use App\Models\Attributescategory;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\Productsrate;
use App\Models\Trder\Trader;
use Livewire\Component;
use DB;
class ProductDetails extends Component
{
    public $rating=0,$message,$show_all=true,$positive_repl=false,$negative_repl=false,
   $product_id,
    $describtion=true,$specification=false,$vendor_info=false,$reviews=false
    ,$onerating,$fiverating,$fourrating,$threerating,$tworating,$avgrating;

    public function mount($product_id){
        $this->product_id=$product_id;
    }
    public function render()
    {
        
        // $countRating=0.0;
        $sumrating = Productsrate::where('product_id',$this->product_id)->sum('rate');
        $countrating = Productsrate::where('product_id',$this->product_id)->count();
        if ($countrating > 0) {
            $this->avgrating = $sumrating/$countrating;
        }
        $sumonepercent = Productsrate::where([
             'rate'=>1
            ,'product_id'=>$this->product_id
            ])->sum('rate');
        $sumtwopercent = Productsrate::where([
                'rate'=>2
               ,'product_id'=>$this->product_id
            ])->sum('rate');
        $sumthreepercent = Productsrate::where([
                'rate'=>3
               ,'product_id'=>$this->product_id
            ])->sum('rate');
        $sumfourpercent = Productsrate::where([
                'rate'=>4
               ,'product_id'=>$this->product_id
            ])->sum('rate');
        $sumfivepercent = Productsrate::where([
                'rate'=>5
               ,'product_id'=>$this->product_id
            ])->sum('rate');
            // dd(($avgrating/5)*100);
            if ($sumrating > 0) {
            $this->onerating = (($sumonepercent  / $countrating ) /  $this->avgrating) * 100;
            $this->tworating = (($sumtwopercent / $countrating ) / $this->avgrating) * 100;
            $this->threerating = (($sumthreepercent / $countrating ) /  $this->avgrating)* 100;
            $this->fourrating = (($sumfourpercent / $countrating ) / $this->avgrating) * 100 ;
            $this->fiverating = (($sumfivepercent / $countrating ) /  $this->avgrating) * 100;
            }
            // dd($onerating);
      
        
        $product = Product::with(['atts_cats','products_rates' => function ($query) {
                $query->select('trader_id', 'product_id','rate','notes','is_approved','created_at');
            }
        ])
        ->where('is_active', 'Y')
        ->find($this->product_id);
        // <!-- dd($product->products_rates->rate); -->
        // $trader = Trader::select('name')->find($product->id);
       
        return view('trader::livewire.products.product-details',compact('product'));
    }

    public function show_describtion(){
        $this->describtion=true;
        $this->specification=false;
        $this->vendor_info=false;
        $this->reviews=false;
    }
    public function show_specification(){
        $this->describtion=false;
        $this->specification=true;
        $this->vendor_info=false;
        $this->reviews=false;
    }
    public function show_vendor_info(){
        $this->describtion=false;
        $this->specification=false;
        $this->vendor_info=true;
        $this->reviews=false;
    }
    public function show_reviews(){
        $this->describtion=false;
        $this->specification=false;
        $this->vendor_info=false;
        $this->reviews=true;
    }


    public function setRating($rate){
        $this->rating = $rate;
    }
    
   
    public function positive_trader_replies(){
        $this->positive_repl=true;
        $this->show_all=false;
        $this->negative_repl=false;


    }
    public function negative_trader_replies(){
        $this->negative_repl=true;
        $this->positive_repl=false;
        $this->show_all=false;


    }
    
    public function saveReview(){
        if(auth()->guard('trader')->check()){
        $reviewproduct = new Productsrate();
        $reviewproduct->trader_id=auth()->guard('trader')->user()->id;
        $reviewproduct->product_id=$this->product_id;
        $reviewproduct->rate=$this->rating;
        $reviewproduct->notes=$this->message;
        $reviewproduct->save();
        }else{
        return redirect()->route('trader.loginastrader');
        }
        $this->message='';
    }
    public function show_all_replies(){
       $this->show_all=true;
       $this->positive_repl=false;
       $this->negative_repl=false;

    }
    
   
   
    
    
}
