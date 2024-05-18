<?php

namespace Modules\Vendors\Livewire\Products;

use App\Models\Product;
use App\Models\Productsstock as ModelsProductsstock;
use App\Models\Stock;
use App\Productsstock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductView extends Component
{
    public $my_products,$company,$product_id,$quantity,$buing_price,$selling_price,$my_stocks,$stock_id,$date_of_enter,$date_of_expire;
    public function render()
    {
        $this->company=Auth::guard('companies')->user();
        $this->my_stocks=Stock::where('company_id',Auth::guard('companies')->user()->id)->get();
        $this->my_products=Product::where('company_id',Auth::guard('companies')->user()->id)->get();
        // dd($this->my_products);
        return view('vendors::livewire.products.product_view')->extends('vendors::components.layouts.app');
    }
    public function get_prod_id($id)
    {
            $this->product_id=$id;
    }
    public function add_new_amount()
    {
        // dd($this->product_id);
// dd($this->stock_id);
        $data=new ModelsProductsstock;
        $data->stock_id= $this->stock_id;
        $data->product_id= $this->product_id;
        $data->quantity= $this->quantity;
        $data->buing_price= $this->buing_price;
        $data->selling_price= $this->selling_price;

        if ($this->date_of_enter >$this->date_of_expire) {
            session()->flash('error','date is un logic ');
        } else {
            $data->date_of_enter= $this->date_of_enter;
            $data->date_of_expire= $this->date_of_expire;
            $data->save();
            session()->flash('message','data is added succefully ');

        }
    }

}
