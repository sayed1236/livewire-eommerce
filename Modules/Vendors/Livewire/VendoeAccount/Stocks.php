<?php

namespace Modules\Vendors\Livewire\VendoeAccount;

// use App\Models\Stock;

use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stocks extends Component
{
    public $name,$id_number,$address,$notes,$stocks;

    public function render()
    {
        if (Auth::guard('companies')->user()) {
            $this->stocks=Stock::where('company_id',Auth::guard('companies')->user()->id)->get();
            // dd($this->stock);
          }

        return view('vendors::livewire.vendoe-account.stocks');

    }
    public function add_stock()
    {
        $this->validate([
            'name'=>'required|unique:stocks,stock_name',
            'id_number'=>'required|numeric|unique:stocks,stock_id_num',
            'address'=>'required|string',
            'notes'=>'required|string',

        ]);
        // dd($this->name);
        // session()->flash('success_message','تم التسجيل بنجاح');
      // dd(session()->has('success_message'));
        $data=new Stock();
        $data->stock_name=$this->name;
        $data->stock_id_num=$this->id_number;
        $data->address=$this->address;
        $data->notes=$this->notes;
        $data->company_id=Auth::guard('companies')->user()->id;

        $data->save();

        session()->flash('success_message','  The stock is added succesfully .');
        // $this->resetPassword();
        // return redirect()->route('login-home');
        return ('success_message');
    }
    public function activation($id)
        {
        $activation_state=Stock::find($id);
        if ($activation_state->is_active == 'y') {
            $activation_state->is_active='n';
        }
            else {
                $activation_state->is_active='y';
            }
        $activation_state->update();
        // dd($activation_state->is_active);
        }

}
