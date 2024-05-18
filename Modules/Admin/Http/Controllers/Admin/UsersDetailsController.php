<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Models\users_detail;
use App\Models\countries_citie;

class UsersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0)
    {
        if($type==1){ $title=' بيانات المحاضرين'; }elseif($type==2){ $title=''; }else{ $title='فائزى المسابقات'; }
        $results=users_detail ::where('type',$type)->get();
        return view('admin.users_details.index',compact('results','type','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->input('type');
        if($type==1){ $title='فائزى المسابقات'; }elseif($type==2){ $title=''; }else{ $title='فائزى المسابقات'; }
        $new_object = new users_detail();
        $result=$new_object->get_new($type);
        $competitions= users_detail::where('type',$type)->get();
        $get_users=User::where('user_level',0)->get();
        return view('admin.users_details.edit',compact('result','type','title','competitions','get_users'));
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
            'user_id'      =>'required',
        ]);
        $data= new users_detail();
        if ($request->hasFile('tax_num_file')) {
            $file = $request->file('tax_num_file');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->tax_num_file = $file_name;
        }
        if ($request->hasFile('commercial_num_file')) {
            $file = $request->file('commercial_num_file');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $commercial_num_file = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $commercial_num_file;
            $file->move($destinationPath, $commercial_num_file);
            $data->commercial_num_file = $commercial_num_file;
        }
        $data->user_id=$request->user_id;
        $data->facility_name=$request->facility_name;
        $data->tel=$request->tel;
        $data->tax_number=$request->tax_number;
        $data->commercial_number=$request->commercial_number;
        $data->notes=$request->notes;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added=Auth::user()->id;
        $data->save();
        return redirect(url(ADMIN_SITE.'users/t/1'))->with('flash_message','تم الاضافة بنجاح');
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
    public function edit($user_id)
    {
        $title=' بيانات الموردين';
        $result=users_detail::where('user_id',$user_id)->first();
        if(is_null($result) == 1)
        {
            $new_object = new users_detail();
            $result=$new_object->get_new($user_id);
        }
        $get_users=User::find($user_id);
        $city_results=countries_citie::where([['parent_id','=',3],'is_active'=>1])->get();
        return view('admin.users_details.edit',compact('result','city_results','title','get_users','user_id'));
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
            'user_id'      =>'required',
        ]);
        $data= users_detail::find($id);
        // if ($request->hasFile('tax_num_file')) {
        //     $file = $request->file('tax_num_file');
        //     $file_name_tax = date('Y_m_d_h_i_s_').str_slug($request->facility_name).'.'.$file->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads');
        //     $filePath = $destinationPath. "/".  $file_name_tax;
        //     $file->move($destinationPath, $file_name_tax);
        //     $data->tax_num_file = $file_name_tax;
        //     $gt_old_file=users_detail::where('user_id',$id)->first();
        //     if(count($gt_old_file))
        //     {
        //         @unlink("./uploads/".$gt_old_file->tax_num_file);
        //     }
        // }
        // if ($request->hasFile('commercial_num_file')) {
        //     $file = $request->file('commercial_num_file');
        //     $commercial_num_file = date('Y_m_d_h_i_s_').str_slug($request->facility_name).'.'.$file->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads');
        //     $filePath = $destinationPath. "/".  $commercial_num_file;
        //     $file->move($destinationPath, $commercial_num_file);
        //     $data->commercial_num_file = $commercial_num_file;
        //     $gt_old_file=users_detail::where('user_id',$id)->first();
        //     if(count($gt_old_file))
        //     {
        //         @unlink("./uploads/".$gt_old_file->commercial_num_file);
        //     }
        // }
        //insert imgs for product
        $files_names='';
        if ($request->hasFile('files')) {
            
            foreach($request->file('files') as $file)
            {
                    //$path = $request->img->path();    //$extension = $request->img->extension();
                $file_name = date('Y_m_d_h_i_s_').str_slug($request->facility_name).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $filePath = $destinationPath. "/".  $file_name;
                $file->move($destinationPath, $file_name);
                $files_names.=$file_name.',';
            }
        }
        $data->files=$files_names;
        $data->user_id=$request->user_id;
        $data->facility_name=$request->facility_name;
        $data->website=$request->website;
        $data->tel=$request->tel;
        //$data->tax_number=$request->tax_number;
        //$data->commercial_number=$request->commercial_number;
        $data->city_id=$request->city_id;
        $data->region=$request->region;
        $data->address=$request->address;
        $data->best_4it=$request->best_4it;
        $data->count_fields=$request->count_fields;
        $data->product_4souq=$request->product_4souq;
        // $data->latitude=$request->latitude;
        // $data->longitude=$request->longitude;
        $data->notes=$request->notes;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added=Auth::user()->id;
        $data->save();
        return redirect(url(ADMIN_SITE.'users/t/1/0'))->with('flash_message','تم التعديل بنجاح');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax_get($id=0)
    {
        $results=users_detail::where('competition_id',$id)->get();
        foreach($results  as $result)
        {
            $data['something'][]='<option ></option>';
        }
        return json_encode( $data);
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
        $result=users_detail::select('is_active')-> where('id',$id)->first();
        $data= users_detail::find($id);
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
        users_detail::where('id',$id)->delete();
        return redirect()->back();
    }
}
