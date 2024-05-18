<?php

namespace Modules\Trader\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\trader\Trader;

class TraderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('trader::index');
    }
    public function showlogin()
    {
        return view('trader::auth.login');
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('trader::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:15',
            'last_name' => 'required|min:2|max:15',
            'email' => 'required|min:6|unique:traders',
            'password' => 'required|min:2|max:15',
            'address' => 'required|min:8',
            'mobile'=>'required|min:5|unique:traders'
        ]);
        Trader::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'address'=>$request->address,
            'mobile'=>$request->mobile
        ]);
        return redirect()->route('home');
    }
    public function compare(Request $request)
    {
    //    dd($request->all());
        if(auth()->guard('trader')->attempt(['email' => $request->input('email'), 'password' =>$request->input('password')]) ){
            return redirect()->route('dashboard.index');

        }
        elseif(auth()->guard('trader')->attempt(['mobile' => $request->input('mobile'), 'password' =>$request->input('password')]) ){
            return redirect()->route('dashboard.index');

        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('trader::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('trader::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
