<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\users_request;
use App\Models\restaurant_branche;
use App\Models\countries_citie;
use App\Models\admin\User;
use Auth;

class UsersRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0)
    {
        $title='طلبات  الموظفين'; 

        $results=users_request::select('users_requests.id', 'user_id', 'users_requests.type','request_type' ,'num_days', 'users_requests.details', 'files', 'company_id', 'is_approved', 'department_id', 'admin_view', 'is_deleted', 'users_requests.created_at',
                                'users.name as user_name', 'mid_name', 'l_name', 'mobile','cats.name as request_type_name')
                                ->leftJoin('users','users.id','=','user_id')
                                ->leftJoin('cats','cats.id','=','request_type')
                                ->orderBy('users_requests.created_at', 'DESC')->paginate();
        return view('admin.users_requests.index',compact('results','title','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type=$request->input('type');
        $title=' طلبات الموظفين';
        
        $new_object = new users_request();
        $result=$new_object->get_new($type);
        return view('admin.users_requests.edit',compact('result','title','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title='طلب اضافة مطعم:'; 

        $result=users_request::find($id);
        if(is_null($result) == 0)
        {
            // update view
            $result->admin_view=1;
            $result->save();
            $select_contry=array('id','name','name_en as name');
            // get country
            $gt_country=countries_citie::select($select_contry)->find($result->country);
            $result['country_name']=@$gt_country->name;
            // get city
            $gt_city=countries_citie::select($select_contry)->find($result->city);
            $result['city_name']=@$gt_city->name;
            $gt_restaurant_branche=restaurant_branche::select($select_contry)->find($result->restaurant_id);
            $result['restaurant_branche_name']=@$gt_restaurant_branche->name;
            
        }
        return view('admin.users_requests.show',compact('result','title'));
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

    public function active_ms($id)
    {
        //return $request->all();
        $result=users_request::select('is_active')-> where('id',$id)->first();
        $data= users_request::find($id);
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
        users_request::where('id',$id)->delete();
        return redirect()->back();
    }
}
