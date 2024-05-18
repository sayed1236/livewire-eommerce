<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingMs;

class SettingMsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title="الاعدادات العامة";
        $result=SettingMs::find(1);
        return view('admin::admin.setting_ms.edit',compact('result','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_object = new SettingMs;
        $result=$new_object->get_new();
        return view('admin::admin.setting_ms.edit',compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'      =>'required|max:200',
        //     'name_en'   => 'required',
        //     'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        // $data= new SettingMs;
        // if ($request->hasFile('img')) {
        //     $file = $request->file('img');
        //     //$path = $request->img->path();    //$extension = $request->img->extension();
        //     $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads');
        //     $filePath = $destinationPath. "/".  $file_name;
        //     $file->move($destinationPath, $file_name);
        //     $data->img = $file_name;
        // }
        // $data->name=$request->name;
        // $data->name_en=$request->name_en;
        // $data->ord=$request->ord;
        // $data->details=$request->details;
        // $data->details_en=$request->details_en;
        // $data->save();
        // return redirect(route('setting_ms.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result= SettingMs::where('id',$id)->first();
        return view('admin::admin.setting_ms.one',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title="الاعدادات العامة";
        $result=SettingMs::where('id',$id)->first();
        return view('admin::admin.setting_ms.edit',compact('result','title'));
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
            'name_en'   => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'mimes:pdf,doc,docx,xls,jpeg,png,jpg,svg|max:7048'
        ]);
        $destinationPath = public_path('/uploads');
        $data= SettingMs::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = 'logo.'.$file->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        if ($request->hasFile('file')) {
            $file_co = $request->file('file');
            $file_name_co = date('Y_m_d_h_i_s_').str_slug($request->name).'_f.'.$file_co->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name_co;
            $file_co->move($destinationPath, $file_name_co);
            @unlink("./uploads/".$data->file);
            $data->file = $file_name_co;
        }

        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->tel=$request->tel;
        $data->mobile=$request->mobile;
        $data->mobile2=$request->mobile2;
        $data->whatsapp=$request->whatsapp;
        $data->fax=$request->fax;
        $data->email=$request->email;
        $data->email_server=$request->email_server;
        $data->google_map=$request->google_map;
        $data->address=$request->address;
        $data->address_en=$request->address_en;
        $data->save();
        return redirect(route('setting-page.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
