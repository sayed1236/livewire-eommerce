<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\User;
use Auth;
use App\Models\notification;
use App\Models\product;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=0 ,$with_id=0)
    {
        if($type==1){ $title='الاشعارات بمطعم  '; }elseif($type==2){ $title='الاشعارات للعروض'; }else{ $title='الاشعارات العامة'; }
        // if($type == 1 && $with_id >0 )
        // {
        //     $title.=' لمنتج :<b style="color:red"> '. product::find($with_id)->name .'</b>';
        // }
        $wher['type']=$type;

        if($with_id > 0)
        {
            $wher['with_id']= $with_id;
        }
        $results=notification::where($wher)->orderBy('created_at', 'DESC')->get();
        return view('admin.notification.index',compact('results','title','type','with_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type=$request->input('type');
        $with_id=$request->input('with_id');
        $title=' إضافة اشعار  ';
        // if($with_id >0)
        // {
        //     $title=' إضافة اشعار لمنتج :<b style="color:red"> '. product::find($with_id)->name .'</b>';
        // }
        //$main_cats=product::where(['type'=>$type , 'id' => $with_id])->first();
        $new_object = new notification();
        $result=$new_object->get_new($type , $with_id);
        return view('admin.notification.edit',compact('result','title','type','with_id'));//'main_cats',
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
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048'
        ]);

        // if($request->with_id == 0)
        // {
        //     $notification_data=array();
        // }
        // else
        // {
        //     $notification_data=array("id" => $request->with_id);
        // }
        if($request->type == 3 || $request->type == 2)
        {
            $type = $request->type - 2;
            $gt_users=user::select('id','name','onesignal_id')->where(['user_level'=>$type,'is_confirmed'=>1,'is_active'=>1])->get();
            if(count($gt_users))
            {
                foreach ($gt_users as $gt_user) {
                    $users_ids.=$gt_user->id.',';
                    $notification_users[]=$gt_user->onesignal_id;
                }
                array_filter($notification_users);
            }
        }
        else {
          $notification_users=array();
          $users_ids='';
        }
        $data= new notification();
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            //$path = $request->img->path();    //$extension = $request->img->extension();
            $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $filePath = $destinationPath. "/".  $file_name;
            $file->move($destinationPath, $file_name);
            $data->img = $file_name;
        }
        else
        {
            $file_name='';
        }
        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->brief=$request->brief;
        $data->brief_en=$request->brief_en;
        $data->details=$request->details;
        $data->details_en=$request->details_en;
        $data->url_link=$request->url_link;
        $data->with_id=$request->with_id;
        $data->to_users=$users_ids;//$request->to_users;
        $data->type=$request->type;
        $data->onesignal_id=$request->onesignal_id;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $ins=$data->save();
        if ($ins == true) {
            $notification_data=array("onsignal_data_id" => $data->id , "with_id" => $data->with_id);

            sendMessage_onesignal_2app($request->type,$request->name ,$request->details ,$file_name ,$request->name_en ,$request->details_en,$notification_data,$notification_users);
        }

        return redirect(route('notifications.t',[ 'type'=> $request->type , 'with_id'=>$request->with_id]))->with('flash_message','تمت الاضافة بنجاح');
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
        $title='الاشعارات';

        $result=notification::where('id',$id)->first();
        $type= $result->type;
        // $cat_id= $result->cat_id;
        // $main_cats=cat::where(['type'=>$type , 'parent_id' => 0])->get();


        return view('admin.notification.edit',compact('result','main_cats','main_attributes','title','type','cat_id'));
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
        $data= notification::find($id);

        $data->name=$request->name;
        $data->name_en=$request->name_en;
        $data->ord=$request->ord;
        $data->type=$request->type;
        $data->cat_id=$request->cat_id;
        $data->price=$request->price;
        $data->is_special=$request->is_special;
        $data->discount=$request->discount;
        $data->quantity=$request->quantity;
        $data->description=$request->description;
        $data->description_en=$request->description_en;
        $data->user_ip=\Request::ip();
        $data->user_pc_info=$request->header('User-Agent');
        $data->user_added = Auth::User()->id;
        $data->save();
        //update imgs for notification
        if ($request->hasFile('img')) {
            $ord_img=1;
            // $gt_old_file=notification::where('id',$id)->first();
            // if(count($gt_old_file))
            // {
            //     @unlink("./uploads/".$gt_old_file->img);
            // }
            foreach($request->file('img') as $file)
            {
                //$path = $request->img->path();    //$extension = $request->img->extension();
                $file_name = date('Y_m_d_h_i_s_').str_slug($request->name).$ord_img.'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $filePath = $destinationPath. "/".  $file_name;
                $file->move($destinationPath, $file_name);
                $data_img=new notification_image();
                $data_img->img = $file_name;
                $data_img->notification_id = $id;
                $data_img->save();
                $ord_img++;
            }
        }
        //insert attributes
        if(!empty($request->input('attributes')))
        {
            $del_old_attributes=notification_attribute_value::where('notification_id' , $id )->delete();
            foreach($request->input('attributes') as $key => $attribute)
            {
                if(!empty($attribute))
                {
                    foreach($attribute as $attribute_value)
                    {
                        $data_attribute= new notification_attribute_value();
                        $data_attribute->notification_id=$id;
                        $data_attribute->attribute_id=$key;
                        $data_attribute->value=$attribute_value;
                        $data_attribute->user_ip=\Request::ip();
                        $data_attribute->user_pc_info=$request->header('User-Agent');
                        $data_attribute->user_added = Auth::User()->id;

                        $data_attribute->save();
                    }
                }
            }
        }
        return redirect(route('notifications.t',[ 'type'=> $request->type , 'cat_id'=>$request->cat_id]))->with('flash_message','تم التعديل بنجاح');
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
        $result=notification::select('is_active')-> where('id',$id)->first();
        $data= notification::find($id);
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
     * Remove img in update.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyimg($id)
    {
        echo $id;
        // notification_image::where('id',$id)->delete();
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        notification::where('id',$id)->delete();
        return redirect()->back();
    }
}
