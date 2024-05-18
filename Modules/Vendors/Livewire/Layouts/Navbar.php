<?php

namespace Modules\Vendors\Livewire\Layouts;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user,$active1,$active2,$active3,$categories,$my_products,$category_id,$search_input;
    // public function mount()
    // {
    //     $this->active1='active';
    //     $this->active2='';
    //     $this->active3='';
    // }
    public function render()
    {
        $this->categories = Category::where('type',0)->get();

        $this->user=Auth::guard('companies')->user();
    //    dd( $this->user);
        return view('vendors::livewire.layouts.navbar');
    }
    public function logout()
    {

        Auth::guard('companies')->logout();

        return redirect('vendors/login');
    }
    public function active($id)
    {

        if ($id=1) {
            $this->active1='active';
            $this->active2='';
            $this->active3='';
        }
       else if ($id=2) {
        $this->active1='';
        $this->active2='active';
        $this->active3='';
        }
        else {
            $this->active1='';
            $this->active2='';
            $this->active3='active';
                }
                // dd($this->active1);

    }
    public function search()
    {
        if ($this->category_id) {
            $this->my_products = Product::where(['company_id'=>Auth::guard('companies')->user()->id,'category_id'=>$this->category_id])->where('name', 'like', "%{$this->search_input}%")->get();          }
        else {
            $this->my_products = Product::where(['company_id'=>Auth::guard('companies')->user()->id])->where('name', 'like', "%{$this->search_input}%")->get();
             }
             session()->push('products.0', $this->my_products);
// $r=session()->pull('products.0');
// foreach ($r as $r) {
//     dd($r);
// }

    //    return dd( $this->my_products);
       return redirect('/vendors/stocks-products');

    }
}
