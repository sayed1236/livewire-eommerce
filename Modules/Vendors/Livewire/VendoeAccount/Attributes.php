<?php

namespace Modules\Vendors\Livewire\VendoeAccount;
use App\Models\Attribute;
use App\Models\Attributescategory as ModelsAttributescategory;
use App\Models\Attributescategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productsattribute;
use App\Models\Productsstock;
use App\Models\Stock;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;
// Use Alert;
use RealRashid\SweetAlert\Facades\Alert;

// use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class Attributes extends Component
{
    use WithFileUploads;

    public $name, $id_number, $address, $notes, $image, $products, $category_id,$category_id_for_att, $description, $parent_id, $name_o_a, $value,$my_stocks,
    $all_attributes, $name2, $value2, $all_categories, $main_att, $att_val, $values,$product_id
    ,$stock_id,$quantity,$buing_price,$selling_price,$date_of_enter,$date_of_expire;
    public function mount()
    {
        $this->name2 = "secondary";
        $this->main_att[] = [];
        $this->value2[] = [];

    }
    public function render()
    {
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
        $this->all_attributes=Attribute::where('parent_id',0)->with('attr_values')->get();
        // dd(count($this->all_attributes));
        // if ($main_att) {
        // dd($this->main_att);
        $this->values = Attribute::where('parent_id', $this->main_att)->with('attr_values')->get();
        // dd($this->values);

        // }
        $this->all_categories = Category::where('type',0)->get();
        // dd($this->all_categories);

        if (Auth::guard('companies')->user()) {
            $this->products = Product::where('company_id', Auth::guard('companies')->user()->id)->get();
            // dd($this->stock);
        }
        return view('vendors::livewire.vendoe-account.attributes');
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
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'image|max:9924',

        ]);

        $data = new Product();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->category_id = $this->category_id;
        if ($this->image) {
            // dd($this->image->getClientOriginalName());
            $file_name = $this->image->getClientOriginalName();
            $path = $this->image->storeAs('photos', $file_name, 'public');
            // $data->img=$this->image->getfilename();
            $data->img = '/storage/' . $path;

        }
        $data->company_id = Auth::guard('companies')->user()->id;
        if ($data->save()) {
            $this->product_id=$data->id;
            session()->flash('success_message_product', '  The product is added succesfully .');

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
        foreach ($this->main_att as $value) {
            $data2 = new ModelsAttributescategory;
            $data2->attribute_id = $value;
            $data2->category_id = $this->category_id;
            $data2->save();

            $data3 = new Productsattribute;
            $data3->att_cat_id = $data2->id;
            $data3->product_id = $this->product_id;
            $data3->save();


        }









        // session()->flash('success_message_product', '  The product is added succesfully .');
        // $this->resetPassword();
        // return redirect()->route('login-home');
        // return ('success_message_product');
    }
    public function add_new_amount()
    {
        // dd($this->date_of_enter);
// dd($this->stock_id);
        $data=new Productsstock;
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
    public function add_attribute($parent_id = 0)
    {
        $this->validate([
            'name_o_a' => 'required|unique:attributes,value',
            'category_id_for_att' => 'required',
            // 'value' => 'required|unique:attributes,value',
        ]);

        // dd($this->category_id_for_att);
        $data = new Attribute();
        $data->name = $this->name_o_a;
        $data->value = 'main attribute';
        $data->parent_id = $parent_id;
        $data->save();
        $data2 = new Attributescategory();
        $data2->category_id = $this->category_id_for_att;
        $data2->attribute_id = $data->id;
        $data2->is_main = 'Y';
        $data2->save();
        session()->flash('success_message', '  The Attribute is added succesfully .');
        // $this->resetPassword();
        // return redirect()->route('login-home');
        return ('success_message');
    }
    public function add_attribute_value($parent_id)
    {
        // dd('');
        // $data=new Product();
        // dd(Arr::exists($this->value2, $parent_id));

        // dd($this->value2);
        // if ($parent_id) {

// dd('');
        if (Arr::exists($this->value2, $parent_id)) {
// dd(Arr::exists($this->value2, $parent_id));

            $this->validate([
                // 'name_o_a'=>'required',
                // 'value2' => 'required|unique:attributes,value',
                'value2' => 'required',

            ]);
            // dd($this->value2[$parent_id]);


            $data = new Attribute();
            $data->name = $this->name2;
            $data->value = $this->value2[$parent_id];
            $data->parent_id = $parent_id;



            // dd($data);
            if( $data->save()){
                session()->flash('success_message_for_att_val', '  The Attribute value is added succesfully .');
                $this->value2[]=[];
            }
            // $this->resetPassword();
            // return redirect()->route('login-home');
            return ('success_message');
        } else {
            // $this->js('js'.fire('hey'));
            // swal
            session()->flash('err_Att', '  enter the attribute value first .');
            // dd('');
            // alert()->warning('Title','Lorem Lorem Lorem');




        }
     }

}
