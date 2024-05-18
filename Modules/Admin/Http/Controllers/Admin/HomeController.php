<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Question;
use App\Models\Role;
use App\Models\UsersCar;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title_page='Home';
        $admins=User::where('member_plan','Hi-Admin')->count();
        $members=User::where(['role_id'=>1])->count();
        $technision=User::where(['role_id'=>2])->count();
        $workshops=User::where(['role_id'=>3])->count();
        $roles=Role::count();
        $open_questions=Question::where(['status'=>'open'])->count();
        $close_questions=Question::where(['status'=>'close'])->count();
        $users_cars=UsersCar::where('type',0)->count();
        $fanni_cars=UsersCar::where('type',1)->count();
        $inbox_messages=ContactUs::count();
        return view('admin.home',compact('title_page','admins','members','technision','workshops','roles','open_questions','close_questions','users_cars','fanni_cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
