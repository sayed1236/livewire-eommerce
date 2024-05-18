<?php

namespace App\Http\Controllers\Admin;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\User;
use App\Models\countries_citie;
use App\Models\department;
use Auth;

class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0, Request $request)
    {
        if($type==0){ $title=''; }elseif($type==1){ $title=' العملاء'; }elseif($type==2){ $title='الموظفين'; }
        elseif($type==3){ $title='موظفى الخزينة'; }elseif($type==4){ $title='المشرفين'; }elseif($type==4){ $title='مدير الفرع'; }elseif($type==6){ $title='مديرين الموقع'; }else{ $title=''; }
        $department=0;
        if($request->department)
        {
            $dep= department::select('name')->find($request->department);
            $wher['department']=$request->department;
            $department=$request->department;
            $title.= ' لقسم :<b style="color:red"> '. $dep->name.'</b>';

        }
        $wher['user_level']=$type;
        $wher[]=array('id','>',1);
        $results=User::where($wher)->orderBy('id','DESC')->paginate(150);
        return view('admin.users.index',compact('results','type','department','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->input('type');
        $department = $request->department;
        $new_object = new User();
        $result=$new_object->get_new($type);
        $city_results=countries_citie::where([['parent_id','=',3],'is_active'=>1])->get();
        return view('admin.users.edit',compact('result','type','department','city_results'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:35|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= new User();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        //$data->id=2;
        $data->name=$request->name;
        $data->mid_name=$request->mid_name;
        $data->l_name=$request->l_name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->national_id=$request->national_id;
        $data->gender=$request->gender;
        $data->date_birth=$request->date_birth;
        $data->identifier_num=$request->identifier_num;
        $data->city=$request->city;
        $data->country=2;
        $data->is_confirmed=1;
        $data->user_level=$request->type;
        $data->member_plan=@$request->member_plan;
        $data->department=$request->department;
        $data->type=0;
        $data->password = Hash::make($request['password']);
        //$data->details=$request->details;
        //$data->details_en=$request->details_en;
        $data->save();
        return redirect(url(ADMIN_SITE.'users/t/'.$request->type.'/'.$request->department))->with('flash_message','تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , Request $request)
    {
        $data=User::select('id', 'type', 'user_level', 'name', 'mid_name', 'l_name', 'email', 'mobile', 'password as uPass', 'img', 'title', 'country', 'city', 'region', 'address', 'gender', 'user_name', 'date_birth', 'is_active', 'is_confirmed', 'user_balance', 'register_from', 'activitation_code', 'access_key', 'ios_token', 'onesignal_id', 'is_connect', 'remember_token', 'created_at', 'updated_at')->where('id',$id)->first();
        if($request->pass)
        {
            $data['newPass']= Hash::make($request->pass);
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=User::where('id',$id)->first();
        if(is_null($result)==1)
        {
            $new_object = new User();
            $result=$new_object->get_new();
        }
        else
        {
            $type=$result->user_level;
        
        }
        $department = $result->department;
        $city_results=countries_citie::where([['parent_id','=',3],'is_active'=>1])->get();
        
        return view('admin.users.edit',compact('result','type','department','city_results'));
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
            'name' => 'required|string|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= User::find($id);
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
        $data->mid_name=$request->mid_name;
        $data->l_name=$request->l_name;
        $data->identifier_num=$request->identifier_num;
        //$data->email=$request->email;
        //$data->mobile=$request->mobile;
        $data->national_id=$request->national_id;
        $data->gender=$request->gender;
        $data->date_birth=$request->date_birth;
        $data->city=$request->city;
        $data->member_plan=@$request->member_plan;
        if(!empty($request['password']))
        {
            $data->password = Hash::make($request['password']);
        }
        //$data->details=$request->details;
        //$data->details_en=$request->details_en;
        $data->save();
        return redirect(url(ADMIN_SITE.'users/t/'.$request->type.'/'.$request->department))->with('flash_message','تمت الاضافة بنجاح');
    }

    public function update_password()
    {
        $result=Auth::User();
        return view('admin.users.update_password',compact('result'));
    }
    
    public function update_pass(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data= Auth::User();
        if(!empty($request['password']))
        {
            $data->password = Hash::make($request['password']);
            $data->save();
        }
        return redirect(url(ADMIN_SITE.'update-password'))->with('flash_message','successfully updated');
    }
    /**
     * export excel the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
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
        $result=User::select('is_active')-> where('id',$id)->first();
        $data= User::find($id);
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

    public function confirmed_ms($id)
    {
        //return $request->all();
        $result=User::select('is_confirmed')-> where('id',$id)->first();
        $data= User::find($id);
        $data->is_confirmed =1;
        $data->activitation_code ='';
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
        User::where('id',$id)->delete();
        return redirect()->back();
    }
}
