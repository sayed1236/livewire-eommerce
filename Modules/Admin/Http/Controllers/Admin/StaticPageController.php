<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=StaticPage::all();
        return view('admin::admin::admin.static_pages.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_object = new StaticPage();
        $result=$new_object->get_new();
        return view('admin::admin.static_pages.edit',compact('result'));
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
        $data= new StaticPage();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').Str::slug($request->name).'.'.$file->getClientOriginalExtension();
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
        return redirect(route('static_pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result=StaticPage::where('id',$id)->first();
        return view('admin::admin.static_pages.one',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title_page=__('ms_lang.btn_edit').': ';
        $script_editor=true;
        $result=StaticPage::find($id);
        $title_page.= Auth::user()->user_lang=='ar' ? $result->name : $result->name_en;
        return view('admin::admin.static_pages.edit',compact('result','title_page','script_editor'));
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
        $data= StaticPage::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').Str::slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            @unlink("./uploads/".$data->img);
            $data->img = $file_name;

        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->save();
        return redirect(route('static_pages.show',$id));
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
        $result=StaticPage::select('is_active')-> where('id',$id)->first();
        $data= StaticPage::find($id);
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
        StaticPage::where('id',$id)->delete();
        return redirect()->back();
    }
}
