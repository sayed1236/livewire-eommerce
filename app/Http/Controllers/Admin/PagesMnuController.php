<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PagesMnu;

class PagesMnuController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id=0)
    {
        $title=' الصفحات >';
        if($parent_id >0 )
        {
            $title.=PagesMnu::where('id',$parent_id)->first()->name;
        }
        $results=PagesMnu::where('parent_id',$parent_id)->get();
        return view('admin.pages_mnu.index',compact('results','parent_id','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$type = $request->input('type');
        $parent_id = $request->input('p_id');
        $new_object = new PagesMnu();
        $result=$new_object->get_new($parent_id);
        return view('admin.pages_mnu.edit',compact('result','parent_id'));
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
            'name_en'   => 'required'
        ]);
        $data= new PagesMnu;
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->page_url=$request->page_url;
        $data->img=$request->img;
        $data->parent_id=$request->parent_id;
        $data->save();
        return redirect(url(config('app.url_admin').'pages_mnu/t/'.$request->parent_id))->with('flash_message','تمت الاضافة بنجاح');
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
        $result=PagesMnu::where('id',$id)->first();
        return view('admin.pages_mnu.edit',compact('result'));
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
            'name_en'   => 'required'
        ]);
        $data= PagesMnu::find($id);

        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->page_url=$request->page_url;
        $data->img=$request->img;
        $data->parent_id=$request->parent_id;
        $data->save();
        return redirect(url(config('app.url_admin').'pages_mnu/t/'.$request->parent_id))->with('flash_message','تم التعديل بنجاح');
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
        $data= PagesMnu::find($id);
        if($data->is_active == 'Y')
        {
            $data->is_active='N';
        }
        else
        {
            $data->is_active ='Y';
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
        PagesMnu::where('id',$id)->delete();
        return redirect()->back();
    }
}
