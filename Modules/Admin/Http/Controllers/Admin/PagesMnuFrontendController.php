<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\pages_mnu_frontend;

class PagesMnuFrontendController extends Controller
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
    public function index($parent_id=0)
    {
        $title=' الصفحات الخارجيه للموقع >';
        if($parent_id >0 )
        {
            $title.=pages_mnu_frontend::where('id',$parent_id)->first()->name;
        }
        $results=pages_mnu_frontend::where('parent_id',$parent_id)->get();
        return view('admin.pages_mnu_frontend.index',compact('results','parent_id','title'));
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
        $new_object = new pages_mnu_frontend();
        $result=$new_object->get_new($parent_id);
        return view('admin.pages_mnu_frontend.edit',compact('result','parent_id'));
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
        $data= new pages_mnu_frontend;
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
        $data->view_in_header=(int)$request->view_in_header;
        $data->view_in_footer=(int)$request->view_in_footer;
        $data->target_link=$request->target_link;
        $data->page_url=$request->page_url;
        $data->class_css=$request->class_css;
        $data->title=$request->title;
        $data->title_en=$request->title_en;
        $data->keywords=$request->keywords;
        $data->keywords_en=$request->keywords_en;
        $data->description=$request->description;
        $data->description_en=$request->description_en;
        $data->parent_id=$request->parent_id;
        $data->save();
        return redirect(url(ADMIN_SITE.'pages_mnu_frontend/t/'.$request->parent_id))->with('flash_message','تمت الاضافة بنجاح');
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
        $result=pages_mnu_frontend::where('id',$id)->first();
        return view('admin.pages_mnu_frontend.edit',compact('result'));
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
        $data= pages_mnu_frontend::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            @unlink("./uploads/".$data->img);
            $data->img = $file_name;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->view_in_header=(int)$request->view_in_header;
        $data->view_in_footer=(int)$request->view_in_footer;
        $data->target_link=$request->target_link;
        $data->page_url=$request->page_url;
        $data->class_css=$request->class_css;
        $data->title=$request->title;
        $data->title_en=$request->title_en;
        $data->keywords=$request->keywords;
        $data->keywords_en=$request->keywords_en;
        $data->description=$request->description;
        $data->description_en=$request->description_en;
        $data->parent_id=$request->parent_id;
        $data->save();
        return redirect(url(ADMIN_SITE.'pages_mnu_frontend/t/'.$request->parent_id))->with('flash_message','تم التعديل بنجاح');
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
        $result=pages_mnu_frontend::select('is_active')-> where('id',$id)->first();
        $data= pages_mnu_frontend::find($id);
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
        pages_mnu_frontend::where('id',$id)->delete();
        return redirect()->back();
    }
}
