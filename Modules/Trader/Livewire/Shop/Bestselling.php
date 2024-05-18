<?php

namespace Modules\Trader\Livewire\Shop;

use Livewire\Attributes\On; 
use App\Models\TraderOrder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Trader_History_Log;
use App\Models\TraderFavorite;
use Illuminate\Support\Facades\Cookie;
use Livewire\WithPagination;

class Bestselling extends Component
{
    use WithPagination;

    public $comparisonProducts = [],$categoryid,$the_modal;

    public $subcategories,$mainCategoryVisible=true,$min_price,$max_price,$category_id,$sortprice,$attribute_id=[],$show=true;
    public function mount(){
        $this->att_id=null;
        $this->perPage = 2;
        // $this->orderby = 'asc';

     }
    public function render()
    {
        $descendantCategoryIds=[];
        $arr=[];
      
        if($this->category_id !==null){
            $category = Category::find($this->category_id);            
                $descendantCategoryIds = $this->getDescendantCategoryIds($category);
                $descendantCategoryIds[] = $this->category_id;
        }
        $more_sales=DB::table('products')
        ->join('orders_products', 'products.id', '=', 'orders_products.product_id')
        ->selectRaw('product_id,SUM(orders_products.quantity) as total')
        ->groupBy('product_id')
        ->orderBy('total','desc')
        ->take(6)
        ->get();
        if(count($more_sales)){
             foreach($more_sales as $key=>$value){
                array_push($arr,$value->product_id);
             }
        }
        $products = Product::select([
            'products.id',
            'products.name',
            'products.img',
            'products.category_id',
            'products.created_at',
            DB::raw('(SELECT selling_price FROM products_stocks WHERE product_id = products.id ORDER BY created_at DESC LIMIT 1) as last_selling_price')
        ])
        ->join('products_attributes', 'products_attributes.product_id', '=', 'products.id')
        ->join('attribute_categories', 'attribute_categories.id', '=', 'products_attributes.attribute_category_id')
        ->join('attributes', 'attributes.id', '=', 'attribute_categories.attribute_id')
        ->when($this->sortprice !== null, function ($qw) {
            if ($this->sortprice == 'date') {
                $qw->orderBy('products.created_at', 'desc');
            } else {
                $qw->orderBy('last_selling_price', $this->sortprice);
            }
        })
        ->when($this->attribute_id , function ($query) {
            // dd($this->attribute_id);

            $query->whereIn('attributes.id', $this->attribute_id);
        })
        ->when($descendantCategoryIds, function ($query) use ($descendantCategoryIds) {
            $query->whereIn('products.category_id', $descendantCategoryIds);
        })
        ->when($this->min_price !== null && $this->max_price !== null, function ($query) {
            $query->having('last_selling_price', '>=', $this->min_price)
                  ->having('last_selling_price', '<=', $this->max_price);
        })
        ->groupBy('products.id', 'products.name', 'products.img', 'products.category_id', 'products.created_at')
       ->whereIn('products.id',$arr)->paginate(6);
    
    
    
        

        $categories = Category::select('id', 'name', 'parent_id')->where('parent_id', 0)
        ->get();   
        try {
            $attributescats = Category::with(['attributes' => function ($q) {
                $q->with('attribute_values')->where('parent_id', 0);
            }])
            ->findOrFail($this->category_id);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $attributescats = Category::with(['attributes' => function ($q) {
                    $q->with('attribute_values')->where('parent_id', 0);
                }])->get();
                
        }
        return view('trader::livewire.shop.bestselling', [
            'products' => $products,
            'categories' => $categories,
            'attributescats' => $attributescats,
        ])->extends('trader::components.layouts.app');
    }
    protected function getDescendantCategoryIds($category)
{
    $descendantCategoryIds = [];

    if ($category->sub_category->isNotEmpty()) {
        foreach ($category->sub_category as $subCategory) {
            $descendantCategoryIds = array_merge(
                $descendantCategoryIds,
                $this->getDescendantCategoryIds($subCategory)
            );
        }
    }

    return array_merge($descendantCategoryIds, $category->sub_category->pluck('id')->toArray());
}
    public function show_category($id){
        $this->attribute_id=null;
        $this->category_id=$id;
        $this->mainCategoryVisible = false;
        $this->subcategories = Category::where('parent_id', $id)->get();
    }
    public function getattribute($id){
        if (is_array($this->attribute_id) && in_array($id, $this->attribute_id)) {
            $key = array_search($id, $this->attribute_id);
            unset($this->attribute_id[$key]);
        } else {
            $this->attribute_id[] = $id;
        }
     
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


