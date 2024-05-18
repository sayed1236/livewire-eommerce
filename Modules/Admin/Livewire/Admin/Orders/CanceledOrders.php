<?php

namespace Modules\Admin\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Product;
use App\Models\UsersOrder;
use Livewire\WithPagination;

class CanceledOrders extends Component
{
    public $user_order,$title_page;
    use WithPagination;
    protected $listeners = ['refreshComponent' => '$refresh'];
    protected $paginationTheme='bootstrap';
    public function mount()
    {
        $this->title_page='الطلبات الملغاه';
    }

    public function render()
    {
        $results=UsersOrder::with('user')->where(['status'=>'canceled'])->latest()->paginate();
        return view('admin::livewire.admin.orders.canceled-orders',[
            'results'=>$results
        ])->extends('admin::admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function confirm_canceled_order($id)
    {
        $data=UsersOrder::findOrFail($id);
        $data->is_done='canceled';
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
