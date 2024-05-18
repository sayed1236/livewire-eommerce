<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CitiesDepartment;
use App\Models\cat;
use App\Models\admin\User;
use Auth;
use App\Models\countries_citie;

class CitiesDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($department_id=0)
    {
        
        $gt_dep=cat::select('name')->find($department_id);
        $title='محافظات القطاع: <b style="color:red">'.@$gt_dep->name.'</b>';
        $results=CitiesDepartment::select('cities_departments.id','name','cities_departments.created_at')
                                ->leftJoin('countries_cities' , 'city_id','=','countries_cities.id')
                                ->where(['department_id' => $department_id])->get();
        //dd($results);
        $cities=countries_citie::where(['type'=>0 , 'parent_id' => 3])->get();
        return view('admin.cities_departments.index',compact('results','cities','title','department_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
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
            'department_id'      =>'required|int',
            'city_id'   => 'required'
        ]);
        $data= new CitiesDepartment;
        $data->department_id=$request->department_id;
        $data->city_id=$request->city_id;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        return redirect(route('cities_departments.t',$request->department_id))->with('flash_message','تمت الاضافة بنجاح');
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
        //
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
        //
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
        $result=CitiesDepartment::select('is_active')-> where('id',$id)->first();
        $data= CitiesDepartment::find($id);
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
        CitiesDepartment::where('id',$id)->delete();
        return redirect()->back();
    }
}
