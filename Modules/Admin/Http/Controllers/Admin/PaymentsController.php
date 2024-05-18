<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Payment;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type='evaluation')
    {
        if(Auth::user()->user_lang == 'en')
        {
            $title='payments Requests';
        }
        else
        {
            $title='طلبات الدفع';
        }

        $results=Payment::select('payments.id', 'payment_id', 'transaction_id', 'ref_no', 'amount', 'payable_type', 'payable_id', 'payments.created_at', 'status', 'user_id'
                                    ,'users.name')
                                    ->join('users' , 'payments.user_id','=','users.id')
                                    ->orderBy('id','DESC')->get();
        return view('admin.payments.index',compact('results','type','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.payments.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'amount'      =>'required|max:200'
        ]);
        $data= new Payment();
        $data->payment_id=$request->payment_id;
        $data->transaction_id=$request->transaction_id;
        $data->ref_no=$request->ref_no;
        $data->amount=$request->amount;
        $data->payable_type=$request->payable_type;
        $data->payable_id=$request->payable_id;
        $data->user_id=Auth::User()->id;
        $data->save();
        return redirect(route('payments.index'))->with('flash_message','تمت الاضافة بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * active & diactive the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        //return $request->all();
        $result=MeetingRequest::select('confirmed','approved')-> where('id',$id)->first();
        $data= MeetingRequest::find($id);
        // if($request->user_type == 0)
        // {
        //     $data->manager_approval=2;
        // }
        // else
        // {
        //     $data->hr_approval=2;
        // }
        if($request->approve =='accept')
        {
            $data->confirmed=2;
        }
        else
        {
            $data->confirmed='-1';
        }
        $data->save();
        return redirect()->back()->with('flash_message','تمت العملية بنجاح');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::where('id',$id)->delete();
        return redirect()->back();
    }
}
