<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\video;
use Auth;
use App\Models\admin\user;

class VideosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0)
    {
        if($type==1){ $title='الفيديوهات'; }elseif($type==2){ $title='عن المؤسسه'; }
        elseif($type==3){ $title='فيديو السلايدر'; }elseif($type==4){ $title=''; }else{ $title=''; }
        $results=video::where('type',$type)->get();
        return view('admin.videos.index',compact('results','type','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->input('type');
        $new_object = new video();
        $result=$new_object->get_new($type);
        return view('admin.videos.edit',compact('result','type'));
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime |max:20480'
        ]);
        $data= new video();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        if ($request->hasFile('video')) {
            $file_video = $request->file('video');
            $file_name_video = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file_video->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name_video;
            $file_video->move($destinationPath, $file_name_video);
            $data->video = $file_name_video;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->type=$request->type;
        $data->ord=$request->ord;
        $data->video_url=$request->video_url;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        
        $data->save();
        return redirect(url(ADMIN_SITE.'video/t/'.$request->type));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result=static_page::where('id',$id)->first();
        return view('admin.static_pages.one',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=video::where('id',$id)->first();
        return view('admin.videos.edit',compact('result'));
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
            'video' => 'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime |max:20480'
        ]);
        $data= video::find($id);
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
        if ($request->hasFile('video')) {
            $file_video = $request->file('video');
            $file_name_video = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file_video->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name_video;
            $file_video->move($destinationPath, $file_name_video);
            @unlink("./uploads/".$data->video);
            $data->video = $file_name_video;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->video_url=$request->video_url;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(url(ADMIN_SITE.'video/t/'.$request->type));
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
        $result=video::select('is_active')-> where('id',$id)->first();
        $data= video::find($id);
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
        video::where('id',$id)->delete();
        return redirect()->back();
    }
}
