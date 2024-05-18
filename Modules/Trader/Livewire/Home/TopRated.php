<?php

namespace Modules\Trader\Livewire\Home;
use Livewire\Attributes\On; 
use App\Models\TraderOrder;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Trader_History_Log;
use App\Models\TraderFavorite;
use Illuminate\Support\Facades\Cookie;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class TopRated extends Component
{
    use WithPagination;

    public $comparisonProducts = [],$categoryid,$the_modal;

    public $perPage,$min_price,$max_price,$category_id,$sortprice,$attribute_id,$show=true,$att_id ;
    public function mount(){
        $this->att_id=null;
        $this->perPage = 2;
        // $this->orderby = 'asc';

     }
    public function render()
    {
        $arr_top=[];

        $top_rated=DB::table('products')
        ->join('products_rates', 'products.id', '=', 'products_rates.product_id')
        ->selectRaw('product_id,SUM(products_rates.rate) as total')
        ->groupBy('product_id')
        ->orderBy('total','desc')
        ->take(6)
        ->get();
        if(count($top_rated)){
            foreach($top_rated as $key=>$value){
               array_push($arr_top,$value->product_id);
            }
       }

       $products = Product::with(['discounts_product', 'latestProductStock' => function ($q) {
        $q->when($this->min_price !== null && $this->max_price !== null, function ($query) {
            $query->whereBetween('selling_price', [$this->min_price, $this->max_price]);
        });
    
       
    }])
    ->join('products_stocks', 'products_stocks.product_id', '=', 'products.id')
    ->when($this->sortprice !== null, function ($qw) {
        if ($this->sortprice == 'date') {
            $qw->orderBy('products_stocks.created_at', 'desc'); // Specify the table name
        } else {
            $qw->orderBy('products_stocks.created_at', $this->sortprice); // Specify the table name
        }
    }) // Adjust the join condition as needed
    ->when($this->attribute_id !== null, function ($query) {
        $query->whereHas('attributes', function ($q) {
            $q->whereIn('attributes.id', $this->attribute_id);
        });
    })
    ->when($this->category_id, function ($query) {
        $query->where('category_id', $this->category_id);
    })
    ->select('products.id', 'products.name', 'products.img', 'products.category_id', 'products.created_at')
    ->whereIn('products.id',$arr_top)->paginate(6);
    
    
    
        

        $attributes = Attribute::with(['attribute_values' => function ($q) {
            $q->where('parent_id', '!=', 0);
        }])
        ->where('parent_id', 0)
        ->get();    
            // $this->asd = Product::find($this->att_id);

            $categories=Category::where('type',0)->whereHas('products')->select('id','name','parent_id')->get();
        // dd($asd);
        return view('trader::livewire.home.top-rated',[
            'products' => $products,
            'categories' => $categories,
            'attributes' => $attributes,
        ])->extends('trader::components.layouts.app');
    }
    public function show_category($id){
        $this->attribute_id=null;
        $this->category_id=$id;
    }
    public function getattribute($id){
   
            $this->attribute_id = $id;
            $this->active=true;     
    }
    public function clean_all(){
        $this->attribute_id=null;
        $this->category_id=null;
        $this->orderby=null;
        $this->min_price = null;
        $this->max_price = null;
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
public function grid(){
    $this->show=true;
  }
  public function list(){
    $this->show=false;
}

 
public function show_modal($id){
    // dd($this->the_modal);
    $this->dispatch('modal',$id);
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
public function add_to_compare($id){
    $comparisonList = json_decode(request()->cookie('comparisonList', '[]'), true);
$product = Product::find($id);

if (empty($comparisonList) || !isset($comparisonList[0])) {
    // If the comparison list is empty or doesn't have the first element, create a new one
    $comparisonList = [$id];
} else {
    // Get the first product and its main category
    $firstProduct = Product::find($comparisonList[0]);
    $firstMainCategory = $firstProduct ? getMainCategory($firstProduct->category) : null;

    // Get the main category of the current product
    $currentMainCategory = $product ? getMainCategory($product->category) : null;

    if ($firstMainCategory && $currentMainCategory && $firstMainCategory->id === $currentMainCategory->id) {
        // If the main categories are the same, add the product to the comparison list if not already there
        if (!in_array($id, $comparisonList)) {
            $comparisonList[] = $id;
        }
    } else {
        // If the main categories are different, create a new comparison list with the current product
        $comparisonList = [$id];
    }
}

// Save the updated comparison list in the cookie
cookie()->queue('comparisonList', json_encode($comparisonList), 1440);

        
        
//    
}

public function filterProducts($min,$max){
    $this->min_price = $min;
    $this->max_price = $max;

  }
}
