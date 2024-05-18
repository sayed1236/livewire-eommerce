<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeMails;
use App\Models\subscribe_mails_message;
use Auth;
use App\Models\SubscribeMail;
use App\Models\SubscribeMailsMessage;

class SubscribeMailsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='البريد الوارد';
        $results=SubscribeMail::all();
        return view('admin.subscribe_mails.index',compact('results','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'subject'      =>'required',
            'message'   => 'required',
            'emails' => 'required'
        ]);
        $data= new SubscribeMailsMessage();
        $data->subject=$request->subject;
        $data->message=$request->message;
        $data->emails=implode(',',$request->emails);
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();

        //to send email confirm
        $send_mail_obj = new \stdClass();
        $send_mail_obj->subject = $request->subject;
        $send_mail_obj->sender = config('app.name').' team';
        $send_mail_obj->message = $request->message;
        $send_mail=Mail::to($request->emails)->send(new SubscribeMails($send_mail_obj));
        if(Mail:: failures())
        {
            return 'عفوا هناك خطأ ما: '.Mail:: failures();
        }
        else
        {
            return 'تم الارسال بنجاح';
        }
        
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
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubscribeMail::where('id',$id)->delete();
        return redirect()->back()->with('flash_message','تمت الحذف بنجاح');;
    }
}
