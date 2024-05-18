<?php

namespace Modules\Trader\Livewire\Home;
use Carbon\Carbon;
use Livewire\Attributes\On; 
use App\Models\SubscribeMail;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Productsgallary;
use App\Models\Trader_History_Log;
use Illuminate\Http\Request;
use App\Models\TraderFavorite;
use Livewire\Component;
use App\Models\Product;
use App\Models\TraderOrder;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Auth;

use Cart;

class Home extends Component
{
    public $newarrival=true,$erroremail, $selling=false,$most_popular=false,$product_check_id, $the_modal,$subemail;
    
    public function render()
    {
        session_start();
      
      
        if(! isset($_SESSION['subscribe-show']))
        {
            $_SESSION['subscribe-show'] = true;
        }
        $arr=[];
        $arr_top=[];
        $popular_top=[];
        $products = Product::with(['latestProductStock','products_gallaries'])
        ->whereHas('discounts_product', function ($q) {
            $q->where('discount_percent', '!=', 0);
        })
        ->select('id', 'name', 'img', 'category_id', 'created_at')
        // ->whereDate('created_at', Carbon::today()->toDateString())
        ->get();    
        // dd($products);

        $categories=Category::where('type',0)->where('parent_id',0)->with(['sub_category'=>function($q){
            $q->with(['products'=>function($query){
                $query->select('id','name','img','category_id')->where('is_active','Y');
                $query->with('latestProductStock');
            }])->select('id','name','img','parent_id');
        }])->select('id','name','parent_id')->where('parent_id','0')->get();
      
       
        $newarrivals = Product::with('products_rates','products_gallaries')->select('id','name','img','category_id','created_at')
        ->orderByDesc('id','desc')->take(7)->get();

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
        $more_sales_products=Product::with('trader_history_logs','latestProductStock')->select('id','name','img')->where('is_active','Y')->whereIn('id',$arr)->get();


        $sliders=Productsgallary::where('product_id',0)->get();
    //    dd($sliders);
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
            //   dd($top_rated );

       $top_rated_products=Product::with('products_rates','latestProductStock')->select('id','name','img')->where('is_active','Y')->whereIn('id',$arr_top)->get();
       
       
       $most_popular_products = DB::table('products')
       ->join('trader_history_logs', 'products.id', '=', 'trader_history_logs.product_id')
       ->selectRaw('product_id,SUM(trader_history_logs.id) as total')
       ->groupBy('product_id')
       ->orderBy('total','desc')
       ->take(6)
       ->get();
       if(count($most_popular_products)){
        foreach($most_popular_products as $key=>$value){
           array_push($popular_top,$value->product_id);
        }
       }
       $product_popularity=Product::with('products_rates','latestProductStock')->select('id','name','img')->where('is_active','Y')->whereIn('id',$popular_top)->take(7)->get();
           
   

       $top_views = Product::with('trader_history_logs')->whereHas('trader_history_logs')->where('is_active','Y')->take(7)->get();

      return view('trader::livewire.home.home',compact('products','categories','newarrivals','more_sales_products','sliders','top_rated_products','product_popularity','top_views'))->extends('trader::components.layouts.app');
    }
    public function new_arrivals(){
        $this->newarrival=true;
        
        $this->most_popular=false;
        $this->selling=false;
    }
    public function sellings(){
        $this->selling=true;
        $this->newarrival=false;
        $this->most_popular=false;

       
    }    
    public function most_populars(){
        $this->most_popular=true;
        $this->newarrival=false;
        $this->selling=false;
        

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
    // public function add_to_cart($id){
    //     $product = Product::with('latestProductStock')->findOrFail($id);

    //        $cart= \Cart::add(array(
    //             'id' => $product->id,
    //             'name' => $product->name,
    //             'price' => $product->latestProductStock->selling_price,
    //             'quantity' => 1,
    //             'attributes' => array(
    //                 'img'=> $product->img,

    //             ),
    //             'associatedModel' => $product
    //         ));
    //         $this->dispatch('refreshComponent');
       
    //     //   $this->dispatch('sayed');
    // }
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
    //    $this->dispatch('refreshComponent');
    }
    public function show_category($category_id){
        // dd($category_id);
        return redirect()->route('trader.category', $category_id);

    }
    public function show_modal($id){
        // dd($this->the_modal);
        $this->dispatch('modal',$id);
    }
    public function subscribe(){
        $this->validate([
            'subemail'=> 'email|required'
        ]);

        $chk_email = SubscribeMail::where('email',$this->subemail)->first();
        if(empty($chk_email)){

        $subxcribeemail = new SubscribeMail();
            $subxcribeemail->email = $this->subemail;
            $subxcribeemail->save();
            $this->erroremail ='the email registered  ';

        }else{

            $this->erroremail ='this email already stored ';

        }
        $this->subemail='';

    }
}


