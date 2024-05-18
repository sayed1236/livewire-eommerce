<?php

namespace Modules\Admin\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\UsersOrder;
use Livewire\WithPagination;

class DeliveringOrders extends Component
{
    use WithPagination;
    public $user_order,$title_page;
    protected $paginationTheme='bootstrap';
    public function mount()
    {
        $this->title_page='الطلبات الجاري توصيلها';
    }

    public function render()
    {
        $results=UsersOrder::with('user')->where('status','delivering')->latest()->paginate();
        return view('admin::livewire.admin.orders.delivering-orders',[
            'results'=>$results
        ])->extends('admin::admin.layouts.app',['script_editor'=>true,'script_datatables'=>true]);
    }
    public function confirm_order($id)
    {
        $data=UsersOrder::findOrFail($id);
        $data->status='delivered';
        $data->save();
    }
    public function delete_ms($id)
    {
        $data=UsersOrder::findOrFail($id);
        $data->deleted_at=now();
        $data->save();
    }
    public function user_oreder($id)
    {
        $this->user_order=UsersOrder::with('user','user_order_adress')->findOrFail($id);
    }
}
