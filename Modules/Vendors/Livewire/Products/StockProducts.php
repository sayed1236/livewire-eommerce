<?php

namespace Modules\Vendors\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Productsstock;
use App\Models\ProductStockDiscount;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class StockProducts extends Component
{
    use WithFileUploads;

    public $my_products, $company, $product_id, $quantity, $buing_price, $selling_price, $my_stocks_products, $stock_id, $date_of_enter, $date_of_expire, $my_stocks, $minimum, $maximum, $discount, $my_discounts,$clicked_id,$m_o_q,$img,$hide=0,$all_categories
    , $product_name, $product_description, $product_category,$categories,$products
    ;
    // public function mount()
    //     {
    //         $clicked_id = 0;
    //     }
    public function render()
    {

        $this->all_categories = Category::where('parent_id',0)->with('sub_category')->get();

        if ($this->product_id) {
            $this->my_discounts = ProductStockDiscount::where(['product_id' => $this->product_id])->get();
            // dd( $this->my_discounts);

        }
        $this->categories = Category::where('type',0)->get();
        $this->company = Auth::guard('companies')->user();
        $this->my_stocks = Stock::where('company_id', Auth::guard('companies')->user()->id)->get();
        $this->my_stocks_products = Stock::where('company_id', Auth::guard('companies')->user()->id)
            ->with('stock_products')->get();
        //    $products_search= session()->pull('products.0');
        //    session()->forget('products.0');
           $data10=Session::get('result');
// dd(Session::get('cat_id')  );
        // if (Session::get('cat_id') && Session::get('search_input') ) {
        //     $this->my_products = Product::where(['company_id'=>Auth::guard('companies')->user()->id,'category_id'=>Session::get('cat_id')])->where('name', 'like', "%{Session::get('search_input') }%")->get();        }
        //   else if ( Session::get('cat_id') ) {
        //     $this->my_products = Product::where(['company_id'=>Auth::guard('companies')->user()->id,'category_id'=>Session::get('cat_id')])->get();
        //             //   dd($this->my_products);
        // }
        // else if ( Session::get('search_input')!=null ) {
        //     $this->my_products = Product::where(['company_id'=>Auth::guard('companies')->user()->id,'name'=>'like', "%{Session::get('search_input') }%"])->get();
        //             //   dd($this->my_products);
        // }

        //    else  {
            $this->my_products = Product::where('company_id', Auth::guard('companies')->user()->id)->get();
            // dd($this->my_products);

        // }

        //    dd( $this->my_products);
        //    if ($products_search) {
        //     dd($products_search[0]);
        //     $this->my_products=$products_search[0];
        //       }
        //         else{
        //             $this->my_products = Product::where('company_id', Auth::guard('companies')->user()->id)->get();

        //         }
        // dd( $this->categories);
        return view('vendors::livewire.products.stock-products')->extends('vendors::components.layouts.app');
    }
    public function get_prod_id($id)
    {
        $this->product_id = $id;
        // dd($this->product_id);
    }
    public function get_prod_and_stock_id($proid)
    {
        $this->product_id = $proid;
        // $this->stock_id=$stockid;
        // dd($this->stock_id=$stockid);
    }
    public function add_discount()
    {

        // dd('');
        $data = new ProductStockDiscount;
        $data->stock_id = 0;
        $data->product_id = $this->product_id;
        $data->quantity_from = $this->minimum;
        $data->quantity_to = $this->maximum;
        $data->discount_percent = $this->discount;
        $data->save();
        session()->flash('message', 'discount is added succefully ');

    }
    public function add_new_amount()
    {
        // dd($this->product_id);
// dd($this->stock_id);
        $data = new Productsstock;
        $data->stock_id = $this->stock_id;
        $data->product_id = $this->product_id;
        $data->quantity = $this->quantity;
        $data->buying_price = $this->buing_price;
        $data->selling_price = $this->selling_price;

        if ($this->date_of_enter > $this->date_of_expire) {
            session()->flash('error', 'date is un logic ');
        } else {
            $data->date_of_enter = $this->date_of_enter;
            $data->date_of_expire = $this->date_of_expire;
            $data->save();
            session()->flash('message', 'data is added succefully ');

        }
    }
    public function getproduct($id)
    {
        $this->hide=0;

        $this->clicked_id=$id;
        $product = Product::find($id);
        // dd($product);
        // ,$product_name,$product_description,$product_category

        $this->product_name = $product->name;
        $this->product_description = $product->description;
        $this->img = $product->img;
        // dd($product);
        // $this->product_name=$product->name;
    }
    public function editproduct()
    {
        $productedit = Product::find($this->clicked_id);
        // dd($product);m_o_q
        // ,$product_name,$product_description,$product_category
        if ($this->product_name) {
            $productedit->name = $this->product_name;
        }
         if ($this->m_o_q) {
            $productedit->min_amount_to_buy = $this->m_o_q;
        }

        if ($this->product_description) {
            $productedit->description = $this->product_description;
        }

        if ($this->product_category) {
            $productedit->category_id = $this->product_category;
        }
         if ($this->img) {

                // $file_name = $this->image->getClientOriginalName();
                // $path = $this->image->storeAs('photos', $file_name, 'public');
                // $data->img = '/storage/' . $path;
                $img=$this->img;
                $file_name = date('Y_m_d_h_i_s_').Str::slug($this->product_name).'.'.$img->getClientOriginalExtension();
                // $file_sml_name_img = 'thumbnail_'.$file_name;
                $destinationPath = public_path('/uploads');
                // $destinationPath_smll = public_path('/uploads/thumbnail');
                // to finally create image instances
                //$image = $manager->make($destinationPath."/".$file_name);
                $image_data = Image::make($img->getRealPath());
                // now you are able to resize the instance
                $image_data->resize(768,1024);
                // and insert a watermark for example
                // $waterMarkUrl = public_path('uploads/logo.png');
                // $image_data->insert($waterMarkUrl, 'bottom-right', 10, 10);
                // finally we save the image as a new file
                $img_name = $image_data->save($destinationPath."/".$file_name);
                ///small img
                $image_small_data = Image::make($img->getRealPath());
                // now you are able to resize the instance
                $image_small_data->resize(190,250);
                // and insert a watermark for example
                // $waterMarkUrl = public_path('uploads/logo.png');
                // $image_small_data->insert($waterMarkUrl, 'bottom-right', 5, 5);
                // finally we save the image as a new file
                // $img_sml_name = $image_small_data->save($destinationPath_smll."/".$file_sml_name_img);
                // exit create img
                if(is_null($this->img)==0)
                {
                    @unlink("./uploads/".$this->img);
              }



                        $this->img = $file_name;
            $productedit->img = $this->img;
            // dd($productedit);
        }
       if($productedit->update()) {
        session()->flash('update_message', 'data is updated succefully ');
        return redirect()->back()->with('success','');
       }

    }
    public function delete_discount($id){
        $discount = ProductStockDiscount::find($id);
        $discount->delete();

    }
    public function delete_product(){
        $produc = Product::find( $this->clicked_id);
        $produc->delete();
        $this->hide=1;
        session()->flash('delete_message', 'product is deleted succefully ');

    }
    //  public function show_delete(){

    //     $this->hide=0;

    // }
}
