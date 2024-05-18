<?php
namespace Modules\Vendors\Livewire\Products;

use App\Models\Productsstock;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ProductDetails extends Component
{
    public $my_stocks_products,$product_name,$product_details,$product_img,$product,$m_o_q
    ,$product_category,$discription;


    public function render()
    {
        // $product_details=Productsstock::where('product_id',request("id"))->with('product','stock')->get();
        $my_stocks_products=Stock::where('company_id',Auth::guard('companies')->user()->id)
        ->with(['stock_products'=>function($query){
            $query->where('product_id',request("id"));
        }])->get();

        $this->product_details=Productsstock::where('product_id',request("id"))->with('product','stock')->get();
        // dd($this->product_details);
        $this->product=Productsstock::where('product_id',request("id"))->with('product')->first();


// dd(request("id"));
if($this->product){

    $this->product_name=$this->product->product->name;
    $this->m_o_q=$this->product->product->min_amount_to_buy;
    $this->product_img=$this->product->product->img;
    $this->discription=$this->product->product->description;
   $this->product_category=$this->product->product->category->name;
    }


        // $all_products=Stoc
        // dd(request("id"));
        return view('vendors::livewire.products.details')->extends('vendors::components.layouts.app');
    }
}
