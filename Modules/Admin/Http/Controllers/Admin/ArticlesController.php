<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\article;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=article::all();
        return view('admin.art_min.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_object = new article();
        $result=$new_object->get_new();
        return view('admin.articles.edit',compact('result'));
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
            'name_en'   => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= new article();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->save();
        return redirect(route('articles.index'))->with('success_msg','تمت الاضافة بنجاح');
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
        $result=article::where('id',$id)->first();
        return view('admin.articles.edit',compact('result'));
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
            'name'      =>'required|max:20',
            'name_en'   => 'required'
        ]);
        $data= article::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
            $gt_old_file=article::where('id',$id)->first();
            if(count($gt_old_file))
            {
                @unlink("./uploads/".$gt_old_file->img);
            }
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->save();
        return redirect(route('articles.index'));
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
        $result=article::select('is_active')-> where('id',$id)->first();
        $data= article::find($id);
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
        article::where('id',$id)->delete();
        return redirect()->back();
    }
}
