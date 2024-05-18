<?php

namespace Modules\Admin\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Product;
use App\Models\UsersOrder;
use Livewire\WithPagination;

class NewOrders extends Component
{
    public $user_order,$title_page;
    use WithPagination;
    protected $listeners = ['refreshComponent' => '$refresh'];
    protected $paginationTheme='bootstrap';
    public function mount()
    {
        $this->title_page='الطلبات الجديده';
    }

    public function render()
    {
        $results=UsersOrder::with('user')->where(['status'=>'new','is_done'=>'Y'])->latest()->paginate();
        // dd($results)
        return view('admin::livewire.admin.orders.new-orders',[
            'results'=>$results
        ])->extends('admin::admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function confirm_order($id)
    {
        $data=UsersOrder::findOrFail($id);
        $data->status='working';
        $data->save();
        $this->emit('$refresh');

    }
    public function user_oreder($id)
    {
        $this->user_order=UsersOrder::with('user','user_order_adress')->find($id);
    }
    public function delete_ms($id)
    {
        $data=UsersOrder::findOrFail($id);
        $data->deleted_at=now();
        $data->save();
    }
}
