<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\album;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\User;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0 )
    {
        if($type==0){ $title='سابقة اعمالنا'; }elseif($type==1){$title='المؤتمرات';  }else{ $title=''; }
        $results=album::where(['type'=>$type , 'is_deleted' => 'N'])->orderBy('id','DESC')->get();
        return view('admin.albums.index',compact('results','title','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type=$request->input('type');
        $parent_id=$request->input('parent_id');
        if($type==0){ $title='سابقة اعمالنا'; }elseif($type==1){$title='المؤتمرات';  }else{ $title=''; }
        
        $new_object = new album();
        $result=$new_object->get_new($type , $parent_id);
        return view('admin.albums.edit',compact('result','title','type','parent_id'));
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
        $data= new album();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $file_name_co = date('Y_m_d_h_i_s_').str_slug($request->name).'_c.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name_co;
            $file->move($destinationPath, $file_name_co);
            $data->cover_photo = $file_name_co;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->type=$request->type;
        $data->year=@$request->year;
        $data->date=@$request->date;
        $data->address=@$request->address;
        $data->address_en=@$request->address_en;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('albums.t',[ 'type'=> $request->type ]))->with('flash_message','تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $result=album::where('id',$id)->first();
        $type=$result->type;
        if($type==0){ $title='سابقة اعمالنا'; }elseif($type==1){$title='المؤتمرات';  }else{ $title=''; }
        return view('admin.albums.edit',compact('result','title')); 
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
        $data= album::find($id);
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
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $file_name_co = date('Y_m_d_h_i_s_').str_slug($request->name).'_c.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name_co;
            $file->move($destinationPath, $file_name_co);
            @unlink("./uploads/".$data->cover_photo);
            $data->cover_photo = $file_name_co;
        }
        
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->year=@$request->year;
        $data->date=@$request->date;
        $data->address=@$request->address;
        $data->address_en=@$request->address_en;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('albums.t',[ 'type'=> $request->type ]))->with('flash_message','تم التعديل بنجاح');
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
        $result=album::select('is_active')-> where('id',$id)->first();
        $data= album::find($id);
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
        album::where('id',$id)->delete();
        return redirect()->back();
    }
}
