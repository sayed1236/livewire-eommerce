<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ResponsTraits;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponsTraits;
    public function index()
    {
        try {
            $results=Product::with('store')->select('name','name_en','price','details','details_en','img','store_id')->paginate();
            return $this->success($results);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
    public function show_product($id)
    {
        try {
            $results=Product::with('store')->select('name','name_en','price','details','details_en','img','store_id')->find($id);
            return $this->success($results);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
