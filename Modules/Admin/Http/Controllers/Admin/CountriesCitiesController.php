<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Models\countries_citie;

class CountriesCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0 ,$parent_id=0)
    {
        $title='الدول';
        if($type == 0 && $parent_id >0 )
        {
            $count_city=countries_citie::find($parent_id);
            if(is_null($count_city) == 0)
            {
                if($count_city->parent_id > 0)
                {
                    $title='  المدن لمحافظه :<b style="color:red"> '. $count_city->name .'</b>';
                }
                else
                {
                    $title='  المحافظات لدولة :<b style="color:red"> '. $count_city->name .'</b>';
                }
            }
            
        }
        $results=countries_citie::where(['type'=>$type , 'parent_id' => $parent_id])->get();
        return view('admin.countries_cities.index',compact('results','title','type','parent_id'));
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
        $title='الدول';
        if($type == 0 && $parent_id >0 )
        {
            $title='  المحافظات لدولة :<b style="color:red"> '. countries_citie::find($parent_id)->name .'</b>';
        }
        $new_object = new countries_citie();
        $result=$new_object->get_new($type , $parent_id);
        return view('admin.countries_cities.edit',compact('result','title','type','parent_id'));
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
            'name'      =>'required|max:100',
            'name_en'   => 'required|max:100',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= new countries_citie;
        $destinationPath = public_path('/uploads');
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        if ($request->hasFile('flag')) {
            $file_flag = $request->file('flag');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name_flag = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file_flag->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name_flag;
            $file_flag->move($destinationPath, $file_name_flag);
            $data->flag = $file_name_flag;
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->type=$request->type;
        $data->parent_id=$request->parent_id;
        $data->currency_code=$request->currency_code;
        $data->currency_code_en=$request->currency_code_en;
        $data->currency_code_en=$request->currency_code_en;
        $data->dail_code=$request->dail_code;
        $data->price_move=$request->price_move;
        //$data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('countries_cities.t',[ 'type'=> $request->type , 'parent_id'=>$request->parent_id]))->with('flash_message','تمت الاضافة بنجاح');
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
        $result=countries_citie::where('id',$id)->first();
        $title='الدول';
        if($result->type == 0 && $result->parent_id > 0 )
        {
            $title='  المحافظات لدولة :<b style="color:red"> '. countries_citie::find($result->parent_id)->name .'</b>';
        }
        return view('admin.countries_cities.edit',compact('result','title')); 
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
            'name'      =>'required|max:100',
            'name_en'   => 'required|max:100',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data= countries_citie::find($id);
        $destinationPath = public_path('/uploads');
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            @unlink("./uploads/".$data->img);
            $data->img = $file_name;    
        }
        if ($request->hasFile('flag')) {
            $file_flag = $request->file('flag');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name_flag = date('Y_m_d_h_i_s_f').str_slug($request->name).'.'.$file_flag->getClientOriginalExtension();
            $filePath = $destinationPath. "/".  $file_name_flag;
            $file_flag->move($destinationPath, $file_name_flag);
            @unlink("./uploads/".$data->flag);
            $data->flag = $file_name_flag;    
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->type=$request->type;
        $data->parent_id=$request->parent_id;
        $data->currency_code=$request->currency_code;
        $data->currency_code_en=$request->currency_code_en;
        $data->currency_code_en=$request->currency_code_en;
        $data->dail_code=$request->dail_code;
        $data->price_move=$request->price_move;
        //$data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('countries_cities.t',[ 'type'=> $request->type , 'parent_id'=>$request->parent_id]))->with('flash_message','تم التعديل بنجاح');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_cities(Request $request)
    {
        //dd($request);
        $type=0;
        $p_id=$request->ajax_id;
        if ($p_id == '')
        {
                $arr['something'] = 'اختر احد المحددات اولاً';
        }
        else
        {
            $type=0;
            $selct=array('id', 'parent_id','name', 'name_en','img');
            $wher['type']=$type;
            $wher['parent_id']=$p_id;
            $wher['is_active']=1;
            $results= countries_citie::select($selct)->where($wher)->get();
            if(count($results))
            {
                foreach($results AS $result):
                    $arr['something'] []='<option value="'.$result->id.'">'.$result->name.'</option>';
                endforeach;
                return response()->json( $arr,200);
            }
            else
            {
                $arr['something'] = '<option value="">--- لا توجد نتائج---</option>';
                return response()->json( $arr,200);
            }
        }
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
        $result=countries_citie::select('is_active')-> where('id',$id)->first();
        $data= countries_citie::find($id);
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
        countries_citie::where('id',$id)->delete();
        return redirect()->back();
    }
}
