<?php

namespace Modules\Admin\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\WithPagination;

class Sizes extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $title_page,$showForm,$showDeleted, $type ,$category_id,$sizess,$amount,$ids;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount($id)
    {
       $this->sizess= ProductAttribute::where('product_id',$id)->get();
    }

    public function render()
    {
        return view('livewire.admin.products.sizes')->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function edit_get_countity($id)
    {
        $quan=ProductAttribute::find($id);
        $this->ids=$id;
        $this->amount=$quan->amount;
    }
    public function store()
    {
        $quan=ProductAttribute::find($this->ids);
        $quan->amount=$this->amount;
        $quan->save();
        $this->emit('remove_model');
    }
}
