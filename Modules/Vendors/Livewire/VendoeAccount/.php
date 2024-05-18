<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

// use App\Attributescategory;
use App\Models\Attribute;
use App\Models\Attributescategory as ModelsAttributescategory;
use App\Models\Attributescategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productsattribute;
use App\Models\Productsstock;
use App\Models\Stock;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

use function PHPUnit\Framework\isNull;

class Products extends Component
{
    use WithFileUploads;

    public $name, $id_number, $address, $notes, $image, $products, $category_id,$category_id_for_att, $description, $parent_id, $name_o_a, $value,$my_stocks,
    $all_attributes, $name2, $value2, $all_categories, $main_att, $att_val, $values,$product_id
    ,$stock_id,$quantity,$buing_price,$selling_price,$date_of_enter,$date_of_expire,$show_active,$show_active2,$show_active3,$show_active4,$min_amount_to_buy,$categories;
    public function mount()
    {
        $this->name2 = "secondary";
        $this->main_att[] = [];
        $this->value2[] = [];
        $this->show_active='show active';
        $this->show_active2='';
        $this->show_active3='';
        $this->show_active4='';

    }
    public function render()
    {
        $this->categories=Category::where('type',0)->get();
        // dd( $this->category_id);

        $this->my_stocks=Stock::where('company_id',Auth::guard('companies')->user()->id)->get();

        if ($this->category_id != null) {
            // $this->all_attributes = Attribute::where('parent_id', 0)->with('attr_values')->with('categories_attributes')->get();
            // dd($this->all_attributes);
            $this->all_attributes = Attributescategory::where(['category_id'=> $this->category_id,'is_main'=>'Y'])
            ->with('attribute')
            ->get();

        }
        // else {
        //     $this->all_attributes = Attributescategory::where(['category_id'=> $this->category_id,'is_main'=>'Y'])
        //         ->with('attribute')
        //         ->get();

        // }
        // $this->all_attributes=Attribute::where('parent_id',0)->with('attr_values')->get();
        // dd(count($this->all_attributes));
        // if ($main_att) {
        // dd($this->main_att);
        $this->values = Attribute::where('parent_id', $this->main_att)->with('attr_values')->get();
        // dd($this->values);

        // }
        $this->all_categories = Category::all();
        // dd($this->all_categories);

        if (Auth::guard('companies')->user()) {
            $this->products = Product::where('company_id', Auth::guard('companies')->user()->id)->get();
            // dd($this->stock);
        }
        return view('vendors::livewire.vendoe-account.products');
    }
    public function add_product()
    {


        // dd( $this->category_id);
        // $data=new Product();
        // dd($data);
        // dd( $this->main_att);

        // dd($this->image);
        // dd($this->image);

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'min_amount_to_buy' => 'required',
            'category_id' => 'required',
            'image' => 'image|max:9924',

        ]);

        $data = new Product();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->min_amount_to_buy = $this->min_amount_to_buy;
        $data->category_id = $this->category_id;
        if ($this->image) {
            // $file_name = $this->image->getClientOriginalName();
            // $path = $this->image->storeAs('photos', $file_name, 'public');
            // $data->img = '/storage/' . $path;
            $img=$this->image;
            $file_name = date('Y_m_d_h_i_s_').Str::slug($this->name).'.'.$img->getClientOriginalExtension();
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
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }


        }
                    $data->img = $file_name;

        $data->company_id = Auth::guard('companies')->user()->id;
        if ($data->save()) {
            $this->product_id=$data->id;
            session()->flash('success_message_product', '  The product is added succesfully .');
            $this->show_active='';
            $this->show_active3='';
            $this->show_active4='';
            $this->show_active2='show active';
            // return ('success_message_product');

        }

        // foreach ($this->main_att as $value) {
        //     $data2 = new ModelsAttributescategory;
        //     $data2->attribute_id = $value;
        //     $data2->category_id = $this->category_id;
        //     $data2->save();

        //     $data3 = new Productsattribute;
        //     $data3->att_cat_id = $data2->id;
        //     $data3->product_id = $data->id;
        //     $data3->save();


        // }









        // session()->flash('success_message_product', '  The product is added succesfully .');
        // $this->resetPassword();
        // return redirect()->route('login-home');
        // return ('success_message_product');
    }
    public function add_product_attribute()
    {
        if(isNull($this->main_att[0]))
        {
            // $dispatch('show-post-modal');
            // $this->dispatch('modal-delete fade');
                        session()->flash('null_message_attribute', '  The attribute is empty!  insert its vauue please .');
        }
        else{
        foreach ($this->main_att as $value) {
            $data2 = new ModelsAttributescategory;
            $data2->attribute_id = $value;
            $data2->category_id = $this->category_id;
            $data2->save();

            $data3 = new Productsattribute;
            $data3->attribute_category_id = $data2->id;
            $data3->product_id = $this->product_id;
            $data3->save();

            session()->flash('success_message_attribute', '  The attribute is added succesfully .');
            $this->show_active='';
            $this->show_active2='';
            $this->show_active3='';
            $this->show_active3='show active';

              }
             }
// dd('');








        // $this->resetPassword();
        // return redirect()->route('login-home');
        // return ('success_message_product');
    }
    public function add_new_amount()
    {
        $this->validate([
            'stock_id' => 'required',
            'quantity' => 'required',
            'buing_price' => 'required',
            'selling_price' => 'required',
            'date_of_expire' => 'required',
            'date_of_enter' => 'required',

        ]);
        // dd($this->date_of_enter);
// dd($this->stock_id);
        $data=new Productsstock;
        $data->stock_id= $this->stock_id;
        // dd($this->product_id);
        $data->product_id= $this->product_id;
        $data->quantity= $this->quantity;
        $data->buying_price= $this->buing_price;
        $data->selling_price= $this->selling_price;

        if ($this->date_of_enter >$this->date_of_expire) {
            session()->flash('error','date is un logic ');
        } else {
            $data->date_of_enter= $this->date_of_enter;
            $data->date_of_expire= $this->date_of_expire;
            $data->save();
            session()->flash('success_amount','data is added succefully ');
            $this->show_active='';
            $this->show_active2='';
            $this->show_active3='';
            $this->show_active4='show active';
        }
    }
    // public function add_attribute($parent_id = 0)
    // {
    //     $this->validate([
    //         'name_o_a' => 'required|unique:attributes,value',
    //         'category_id_for_att' => 'required',
    //         // 'value' => 'required|unique:attributes,value',
    //     ]);

    //     // dd($this->category_id_for_att);
    //     $data = new Attribute();
    //     $data->name = $this->name_o_a;
    //     $data->value = 'main attribute';
    //     $data->parent_id = $parent_id;
    //     $data->save();
    //     $data2 = new Attributescategory();
    //     $data2->category_id = $this->category_id_for_att;
    //     $data2->attribute_id = $data->id;
    //     $data2->is_main = 'Y';
    //     $data2->save();
    //     session()->flash('success_message', '  The Attribute is added succesfully .');
    //     // $this->resetPassword();
    //     // return redirect()->route('login-home');
    //     return ('success_message');
    // }
    // public function add_attribute_value($parent_id)
    // {
    //     // dd('');
    //     // $data=new Product();
    //     // dd($this->value2[$parent_id]);

    //     // dd($parent_id);
    //     if ($this->value2[$parent_id]) {


    //         $this->validate([
    //             // 'name_o_a'=>'required',
    //             'value2' => 'required|unique:attributes,value',

    //         ]);
    //         // dd($this->value2[$parent_id]);


    //         $data = new Attribute();
    //         $data->name = $this->name2;
    //         $data->value = $this->value2[$parent_id];
    //         $data->parent_id = $parent_id;


    //         $data->save();
    //         // dd($data);
    //         session()->flash('success_message', '  The Attribute is added succesfully .');
    //         // $this->resetPassword();
    //         // return redirect()->route('login-home');
    //         return ('success_message');
    //     } else {
    //         session()->flash('err_Att', '  The Attribute is  empty .');
    //         return ('err_Att');


    //     }
    // }
}
