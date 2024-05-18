<?php

namespace Modules\Vendors\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public function render()
    {
        return view('vendors::livewire.products.product-edit');
    }
    public function getproduct($id)
    {
    $product = Product::find($id);
    dd($product);
    }
}
