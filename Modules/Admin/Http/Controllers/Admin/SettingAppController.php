<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\setting_app;

class SettingAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=setting_app::all();
        return view('admin.setting_app.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_object = new setting_app;
        $result=$new_object->get_new();
        return view('admin.setting_app.edit',compact('result'));
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
            //'num_free_advs'=>'required|numeric',
            'price_adv'    => 'required|numeric'
        ]);
        $data= new setting_app();
        $data->num_free_advs=@$request->num_free_advs;
        $data->price_adv=$request->price_adv;
        $data->save();
        return redirect(route('setting_app.edit',$data->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result= setting_app::where('id',$id)->first();
        return view('admin.setting_app.one',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title="الاعدادات الخاصه بالشحن";
        $result=setting_app::where('id',$id)->first();
        return view('admin.setting_app.edit',compact('result','title'));
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
            'delivery_price'=>'required|numeric'
        ]);
        $data= setting_app::find($id);
        //$data->num_free_advs=@$request->num_free_advs;
        $data->delivery_price=$request->delivery_price;
        //$data->special_4_12h=$request->special_4_12h;
        //$data->special_4_1day=$request->special_4_1day;
        //$data->special_4_2day=$request->special_4_2day;
        $data->save();
        return redirect(route('setting_app.edit',$id))->with('flash_message','تم التعديل بنجاح');;
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
        $result=setting_app::select('is_active')-> where('id',$id)->first();
        $data= setting_app::find($id);
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
        setting_app::where('id',$id)->delete();
        return redirect()->back();
    }
}
