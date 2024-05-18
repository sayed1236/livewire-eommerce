<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\art_min;
use Illuminate\Support\Facades\Route;

class ArtMinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0,$cat_id=0)
    {
        if($type==1){ $title='الاهداف'; }elseif($type==2){ $title='الاخبار'; }elseif($type==3){ $title='آراء عملاؤنا'; }
        elseif($type==4){ $title='خدماتنا'; }elseif($type==5){ $title='المزيد - ساعات المعرض'; }else{ $title=''; }
        $results=art_min::where('type',$type)->orderBy('id','DESC')->get();
        return view('admin.art_min.index',compact('results','type','title','cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->input('type');
        $cat_id = $request->input('cat_id');
        if($type==1){ $title='الاهداف'; }elseif($type==2){ $title='الاخبار'; }
        elseif($type==3){ $title='آراء عملاؤنا'; }elseif($type==4){ $title='خدماتنا'; }else{ $title=''; }
        
        $new_object = new art_min();
        $result=$new_object->get_new($type,$cat_id);
        return view('admin.art_min.edit',compact('result','type','title'));
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= new art_min();
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
        $data->type=$request->type;
        $data->cat_id=$request->cat_id;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->save();
        return redirect(url(ADMIN_SITE.'art_min/t/'.$request->type.'/'.$request->cat_id))->with('flash_message','تمت الاضافة بنجاح');
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
        $result=art_min::where('id',$id)->first();
        $type=$result->type;
        if($type==1){ $title='الاهداف'; }elseif($type==2){ $title='الاخبار'; }
        elseif($type==3){ $title='آراء عملاؤنا'; }elseif($type==4){ $title='خدماتنا'; }else{ $title=''; }
        
        return view('admin.art_min.edit',compact('result','type','title'));
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= art_min::find($id);
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
        $data->cat_id=$request->cat_id;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->save();
        return redirect(url(ADMIN_SITE.'art_min/t/'.$request->type.'/'.$request->cat_id))->with('flash_message','تم التعديل بنجاح');
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
        $result=art_min::select('is_active')-> where('id',$id)->first();
        $data= art_min::find($id);
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
        art_min::where('id',$id)->delete();
        return redirect()->back();
    }
}
