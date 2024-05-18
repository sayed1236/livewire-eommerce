<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\gallery;
use App\Models\album;

class GalleryController extends Controller
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
    public function index($type=0,$cat_id=0)
    {
        if($type==1){ $title='المؤتمرات'; }elseif($type==2){ $title='خريطه الموقع'; }elseif($type==3){ $title='الصور'; }
        elseif($type==4){ $title='الشركاء'; }elseif($type==5){ $title='السلايدر'; }else{ $title=''; }
        $results=gallery::where(['type'=>$type,'cat_id'=>$cat_id])->orderBy('id','DESC')->get();
        if($cat_id > 0)
        {
            $gt_albm=album::select('name')->find($cat_id);
            $title.=' ->'.@$gt_albm->name;
        }
        return view('admin.gallery.index',compact('results','type','cat_id','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type=$request->type;
        $cat_id=$request->cat_id;
        $new_object = new gallery();
        $result=$new_object->get_new($type,$cat_id);
        if($type==1){ $title='المؤتمرات'; }elseif($type==2){ $title='خريطه الموقع'; }elseif($type==3){ $title='الصور'; }
        elseif($type==4){ $title='الشركاء'; }elseif($type==5){ $title='السلايدر'; }else{ $title=''; }
        
        if($cat_id > 0)
        {
            $gt_albm=album::select('name','name_en')->find($cat_id);
            $result->name=@$gt_albm->name;
            $result->name_en=@$gt_albm->name_en;
        }
        
        return view('admin.gallery.edit',compact('result','title'));
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
        $data= new gallery();
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
        $data->type=$request->type;
        $data->cat_id=$request->cat_id;
        $data->save();
        return redirect(url(ADMIN_SITE.'galleries/t/'.$request->type.'/'.$request->cat_id))->with('flash_message','تمت الاضافه بنجاح');
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
        $result=gallery::where('id',$id)->first();
        return view('admin.gallery.edit',compact('result'));
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
        $data= gallery::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
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
        $data->cat_id=$request->cat_id;
        $data->save();
        return redirect(url(ADMIN_SITE.'galleries/t/'.$request->type.'/'.$request->cat_id))->with('flash_message','تم التعديل بنجاح');
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
        $result=gallery::select('is_active')-> where('id',$id)->first();
        $data= gallery::find($id);
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
        gallery::where('id',$id)->delete();
        return redirect()->back()->with('flash_message','تم الحذف بنجاح');
    }
}
