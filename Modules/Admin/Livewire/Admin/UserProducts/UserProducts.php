<?php

namespace Modules\Admin\Livewire\Admin\UserProducts;

use Livewire\Component;
use App\Models\ArtMin;
use App\Models\Product;
use Livewire\WithPagination;

class UserProducts extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $title_page,$showForm,$showDeleted, $type ,$category_id,$result_one;
    public $btn_kwrd;
    public $edit_object;
    protected $listeners=[
        'objectEdit'=>'refresh_edited'
    ];
    public function mount()
    {
        $this->title_page='منتجات المستخدمين';
        $this->showForm=false;
        $this->showDeleted=false;
        $this->btn_kwrd = trans('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function render()
    {
        $results=Product::with('user','gallaries')->where('is_active','N')->where('user_id','>','0')->paginate();
        return view('livewire.admin.user-products.user-products',[
            'results'=>$results
        ])->extends('admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function detatils($id)
    {
        $this->result_one=Product::find($id);
        $this->emit('openRecordsModal');
    }

    public function deleted()
    {
        $this->showDeleted=!$this->showDeleted;
        $this->showForm=false;
        if($this->showDeleted == true)
        {
            $this->title_page='Deleted';
            $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
        }
        else
        {
            $this->title_page='View';
            $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
        }
    }
    public function edit_form($id=0)
    {
        $this->showForm=!$this->showForm;
        if($id > 0)
        {
            if($this->showForm == true)
            {
                $this->title_page='Edit';
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page='View';
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $edit_object= ArtMin::where('deleted_at',null)->whereId($id)->first();
        }
        else
        {
            if($this->showForm == true)
            {
                $this->title_page='Add';
                $this->btn_kwrd=__('ms_lang.btn_view_all').' <i class="icon-xl fas fa-list text-danger"></i>';
            }
            else
            {
                $this->title_page='View';
                $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
            }
            $add_object=new ArtMin();
            $edit_object=$add_object->get_new($this->type,$this->category_id);
        }
        if($edit_object)
        {
            $this->emit('getObject',$edit_object);
        }

    }

    public function refresh_edited()
    {
        session()->flash('success_message','successfully updated');
        $this->showForm=false;
        $this->btn_kwrd = __('ms_lang.btn_add_new').' <i class="icon-xl fas fa-pencil-ruler"></i>';
    }

    public function active_ms($id=0)
    {
        $data= Product::select('id','is_active')->find($id);
        if($data->is_active == 'Y')
        {
            $data->is_active='N';
        }
        else
        {
            $data->is_active ='Y';
        }
        $data->save();
    }
    public function refused($id=0)
    {
        $data= Product::select('id','is_active')->find($id);
        $data->is_active='R';
        $data->save();
    }

    public function delete_ms($id=0)
    {
        $data= Product::select('id','deleted_at')->find($id);
        if($data->deleted_at == null)
        {
            $data->deleted_at=now();
        }
        else
        {
            $data->deleted_at =null;
        }
        $data->save();
    }
}
