<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Models\advertising;
use App\Models\restaurant_branche;
use App\Models\countries_citie;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0)
    {
        if($type==1){ $title='الاعلانات'; }elseif($type==2){ $title=''; }else{ $title=''; }
        $results=advertising::where('type',$type)->get();
        return view('admin.advertising.index',compact('results','type','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = (int)$request->input('type');
        $new_object = new advertising();
        $result=$new_object->get_new($type);
        if($type == 1)
        {
            $with_ids= countries_citie ::where(['is_active'=>1,['parent_id','=',0]])->get();
            $title_field='الدول';
        }
        elseif($type== 2)
        {
            $with_ids= countries_citie ::where(['is_active'=>1,['parent_id','>',0]])->get();
            $title_field='المدن';
        }
        else
        {
            $with_ids= restaurant_branche :: get();
            $title_field='المطاعم';
        }
        
        return view('admin.advertising.edit',compact('result','type','with_ids','title_field'));
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
        $data= new advertising();
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
        $data->ord=$request->ord;
        $data->url_l=$request->url_l;
        $data->with_id=$request->with_id;
        $data->google_adv=$request->google_adv;
        $data->v_in_home=0;
        $data->v_in_slide=0;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(url(ADMIN_SITE.'advertising/t/'.$request->type))->with('flash_message','تمت الاضافة بنجاح');
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
        $result=advertising::where('id',$id)->first();
        $type=$result->type;
        if($type == 1)
        {
            $with_ids= countries_citie ::where(['is_active'=>1,['parent_id','=',0]])->get();
            $title_field='الدول';
        }
        elseif($type== 2)
        {
            $with_ids= countries_citie ::where(['is_active'=>1,['parent_id','>',0]])->get();
            $title_field='المدن';
        }
        else
        {
            $with_ids= restaurant_branche :: get();
            $title_field='المطاعم';
        }
        return view('admin.advertising.edit',compact('result','with_ids','title_field'));
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
        $data= advertising::find($id);
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
        $data->type=$request->type;
        $data->ord=$request->ord;
        $data->url_l=$request->url_l;
        $data->with_id=$request->with_id;
        $data->google_adv=$request->google_adv;
        $data->v_in_home=0;
        $data->v_in_slide=0;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(url(ADMIN_SITE.'advertising/t/'.$request->type))->with('flash_message','تم التعديل بنجاح');
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
        $result=advertising::select('is_active')-> where('id',$id)->first();
        $data= advertising::find($id);
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
        advertising::where('id',$id)->delete();
        return redirect()->back();
    }
}
