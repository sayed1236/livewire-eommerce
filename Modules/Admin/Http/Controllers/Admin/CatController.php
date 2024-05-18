<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\cat;
use Illuminate\Support\Facades\Route;
use App\Models\admin\User;
use Auth;
class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0 ,$parent_id=0)
    {
        if($type==1){ $title='الاقسام'; }elseif($type==2){$title='Ads Places';  }
        elseif($type==3){ $title='Packges'; }elseif($type==4){ $title='انواع طلبات الموظفين'; }else{ $title=''; }
        if($type == 1 && $parent_id >0 )
        {
            $title.=' الفرعية لـقسم :<b style="color:red"> '. cat::find($parent_id)->name .'</b>';
        }
        $results=cat::where(['type'=>$type , 'parent_id' => $parent_id])->get();
        return view('admin.cat.index',compact('results','title','type','parent_id'));
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
        if($type==1){ $title='الاقسام'; }elseif($type==2){$title='Ads Places';  }
        elseif($type==3){ $title='Packges'; }elseif($type==4){ $title='انواع طلبات الموظفين'; }else{ $title=''; }

        $new_object = new cat();
        $result=$new_object->get_new($type , $parent_id);
        return view('admin.cat.edit',compact('result','title','type','parent_id'));
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
        $data= new cat;
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
        $data->parent_id=$request->parent_id;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('cat.t',[ 'type'=> $request->type , 'parent_id'=>$request->parent_id]))->with('flash_message','تمت الاضافة بنجاح');
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

        $result=cat::where('id',$id)->first();
        $type=$result->type;
        if($type==1){ $title='الاقسام'; }elseif($type==2){$title='Ads Places';  }
        elseif($type==3){ $title='Packges'; }elseif($type==4){ $title='انواع طلبات الموظفين'; }else{ $title=''; }

        return view('admin.cat.edit',compact('result','title'));
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
        $data= cat::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
            if(is_null($data->img)==0)
            {
                @unlink("./uploads/".$data->img);
            }
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->parent_id=$request->parent_id;
        $data->ord=$request->ord;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('cat.t',[ 'type'=> $request->type , 'parent_id'=>$request->parent_id]))->with('flash_message','تم التعديل بنجاح');
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
        $result=cat::select('is_active')-> where('id',$id)->first();
        $data= cat::find($id);
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
        cat::where('id',$id)->delete();
        return redirect()->back();
    }
}
