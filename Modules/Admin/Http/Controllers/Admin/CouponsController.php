<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Models\coupon;
use App\Models\cat;
class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0 )
    {
        if(Auth::user()->user_level == 5)
        {
            $wher['user_id'] = Auth::User()->id;
        }
        $wher['type']=$type;
        $title='الكوبونات';
        $results=coupon::where($wher)->get();
        return view('admin.cءoupons.index',compact('results','title','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type=$request->input('type');
         $title='الكوبونات';
        $new_object = new coupon();
        $result=$new_object->get_new($type);
        $main_cats = cat::where('parent_id',0)->get();
        return view('admin.coupons.edit',compact('result','title','type','main_cats'));
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
            'name'      =>'required|max:200',
            'name_en'   => 'max:200',
            'cat_id'   => 'required|numeric',
            'coupon'   => 'required',
            'amount'   => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= new coupon;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        if(Auth::user()->user_level == 5)
        {
            $data->user_id = Auth::User()->id;
        }
        else
        {
            $data->user_id =5;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->cat_id=$request->cat_id;
        $data->type=$request->type;
        $data->coupon=$request->coupon;
        $data->amount=$request->amount;
        $data->min_total_price=$request->min_total_price;
        $data->max_discount=$request->max_discount;
        $data->date_expire=$request->date_expire;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        sendMessage_onesignal_2app(5,$request->name,'كوبونات جديدة فى كيدوزن ',@$file_name);
        return redirect(route('coupons.t',[ 'type'=> $request->type ]))->with('flash_message','تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title='كوبون';
        if(Auth::user()->user_level == 5)
        {
            $wher['user_id'] = Auth::User()->id;
        }
        $wher['id'] =$id;
        $result=coupon::where($wher)->first();
        $type=$result->type;
        $main_cats = cat::where('parent_id',0)->get();
        
        return view('admin.coupons.edit',compact('result','title','main_cats','type')); 
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
        $this->validate($request,[
            'name'      =>'required|max:200',
            'name_en'   => 'max:200',
            'cat_id'   => 'required|numeric',
            'coupon'   => 'required',
            'amount'   => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if(Auth::user()->user_level == 5)
        {
            $wher['user_id'] = Auth::User()->id;
        }
        $wher['id'] =$id;
        
        $data=coupon::where($wher)->first();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
            $gt_old_file=coupon::where('id',$id)->first();
            if(count($gt_old_file))
            {
                @unlink("./uploads/".$gt_old_file->img);
            }
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->cat_id=$request->cat_id;
        $data->type=$request->type;
        $data->coupon=$request->coupon;
        $data->amount=$request->amount;
        $data->min_total_price=$request->min_total_price;
        $data->max_discount=$request->max_discount;
        $data->date_expire=$request->date_expire;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('coupons.t',[ 'type'=> $request->type ]))->with('flash_message','تم التعديل بنجاح');
    }

    /**
     * active & diactive the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_ms($id)
    {
        //return $request->all();
        $result=coupon::select('is_active')-> where('id',$id)->first();
        $data= coupon::find($id);
        if($result->is_active == 1)
        {
            $data->is_active=0;
        }
        else
        {
            $data->is_active =1;
        }
        $data->save();
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        coupon::where('id',$id)->delete();
        return redirect()->back();
    }
}
