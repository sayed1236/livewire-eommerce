<?php

namespace Modules\Trader\Livewire\Layouts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Product;
use Livewire\Attributes\Rule;
use App\Models\TraderOrder;
use App\Models\Category;
use Cart;

class Navbar extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $category='products',$valuesearch,$results;
    public function mount(){
    }
    public function render()
    {
       


        if(auth('trader')->check()){
            $trader_orders=TraderOrder::with('product')->where('trader_id',auth('trader')->user()->id)->
            orWhere(['user_ip'=>\Request::ip(),'user_pc_info'=>\Request::header('User-Agent')])->get();
        }else{
            $trader_orders=TraderOrder::with('product')->where(['user_ip'=>\Request::ip(),'user_pc_info'=>\Request::header('User-Agent')])->get();
        }
        // $carts= Cart::getContent();
        $categories= Category::whereHas('sub_category')->select('id','parent_id','name','img','img_nave')->whereType(0)->whereParentId(0)->get();
        return view('trader::livewire.layouts.navbar',compact('categories','trader_orders'));
    }
    public function show_category($category_id){
        return redirect()->route('trader.category', $category_id);
    }
    public function delete_prod($id)
    {
        // Cart::remove($id);
        if($id){
            Product::find($id)->delete();
        }
    }
    public function search(){
        // dd($this->category);
        $this->validate([ 
            'valuesearch' => 'required|min:2',
            
        ]);
        if($this->category== 'products'){
            return redirect()->route('trader.search', ['param1' => $this->category, 'param2' => $this->valuesearch]);
        }elseif($this->category== 'vendors'){
            return redirect()->route('trader.searchvendor', ['param1' => $this->category, 'param2' => $this->valuesearch]);

        }
    }
    public function logout()
    {
        auth('trader')->logout();
    }
}
