<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\social_media;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($type=0)
     {
         $title='السوشيال ميديا';
         $results=social_media::where('type',$type)->get();
         return view('admin.social_media.index',compact('results','type','title'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {
         $type = $request->input('type');
         $new_object = new social_media();
         $result=$new_object->get_new($type);
         return view('admin.social_media.edit',compact('result','type'));
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
             'url_l'   => 'required|url',
             'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $data= new social_media();
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
         $data->type=$request->type;
         $data->ord=$request->ord;
         $data->i_icon=$request->i_icon;
         $data->class_so=$request->class_so;
         $data->url_l=$request->url_l;
         $data->user_ip=\Request::ip();
         $data->user_pc_info=$request->header('User-Agent');
         $data->save();
         return redirect(url(ADMIN_SITE.'social_media'))->with('flash_message','تمت الاضافة بنجاح');
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
         $result=social_media::where('id',$id)->first();
         return view('admin.social_media.edit',compact('result'));
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
             'url_l'   => 'required|url',
             'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $data= social_media::find($id);
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
         $data->type=$request->type;
         $data->ord=$request->ord;
         $data->i_icon=$request->i_icon;
         $data->class_so=$request->class_so;
         $data->url_l=$request->url_l;
         $data->user_ip=\Request::ip();
         $data->user_pc_info=$request->header('User-Agent');
         $data->save();
         return redirect(url(ADMIN_SITE.'social_media'))->with('flash_message','تم التعديل بنجاح');
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
         $result=social_media::select('is_active')-> where('id',$id)->first();
         $data= social_media::find($id);
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
         social_media::where('id',$id)->delete();
         return redirect()->back();
     }
}
