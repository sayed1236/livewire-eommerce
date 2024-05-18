<?php

namespace Modules\Trader\Livewire\Layouts;
use Livewire\Attributes\On; 
use App\Models\Product;
use Livewire\Component;
use Livewire\Features\SupportAttributes\AttributeCollection;
use App\Models\TraderOrder;
use App\Models\SubscribeMail;

class FooterMenu extends Component
{
    public $the_modal,$quantity=1,$product_id,$subemail;
    public function render()
    {
        // $_SESSION['preload'] = true;

        return view('trader::livewire.layouts.footer-menu');
    }
    #[On('modal')] 
    public function show_modal($id){
        $this->product_id = $id;
        $this->the_modal = Product::with(['trader_history_logs', 'products_rates', 'latestProductStock','products_gallaries','atts_cats'])->find($id);
         $this->dispatch('show_modal');
    }
    public function plus(){
        $this->quantity++;
    }
    public function minus(){
        if ($this->quantity > 1) {
            $this->quantity--;
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
}
