@extends('admin.layouts.app')

@section('content')

 <script src="{{ url('admin/editor_html/ckeditor.js')}}"></script>
 <script src="{{ url('admin/editor_html/adapters/jquery.js')}}"></script>
    <script>
    $( document ).ready( function() {
        $( 'textarea.editor1' ).ckeditor();
    } );

    </script>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
    <?php
if (isset($result->type) && $result->type==0 ){ $type=$result->user_level; }
    if($type ==1){
        $dis_det='hidden';
        $dis_img='';
        $require_img='required';
    }elseif($type ==2){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='';
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
    }else{
        $dis_det='';
        $dis_img='';
        $require_img='required';
    }
    if(isset($result->type)) $require_img='';
    ?>

                    <h3 class="box-title" style="text-decoration: underline;color:brown">
    <?php 
    /*if (!empty($cat->id))
    {
        echo '<strong>تعديل</strong> :<b style="color:blueviolet">'.$cat->name.'</b>';
        $btn_kw='تعديــــــل';
    }else
    {
        echo 'اضــــــافة جديد/ '.$title;
        $btn_kw='اضافة جديد';
    }*/
    ?>
                    </h3>
                <!-- alert msg-->
                @include('includes.messages')
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <!--button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button-->
              </div>
            </div>
            <div class="box-body pad">
                <form @if (isset($result->id))
                        action="{{route('users.update', $result->id ) }}"
                    @else
                        action="{{route('users.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group {{$dis_img}}">
                        <label for="ord">الصورة</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
@if (isset($type))
    <input type="hidden" name="type" value="{{$type}}" />
@else
    <input type="hidden" name="type" value="{{@$result->type}}" />
@endif
                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="Name">الاسم الاوسط</label>
                        <input type="text" name="mid_name" value="{{ @$result->mid_name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">الاسم الاخير</label>
                        <input type="text" name="l_name" value="{{ @$result->l_name }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">الايميل</label>
                        <input type="email" name="email" value="{{ @$result->email }}" class="form-control" id="email" <?php if($result->email==''){echo 'required=""';}else{ echo 'readonly=""';} ?>/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">كلمة السر</label>
                        <input type="password" name="password"  class="form-control" id="password" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">تأكيد كلمة السر</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="تاكيد كلمة المرور" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">الموبايل</label>
                        <input type="text" name="mobile" value="{{ @$result->mobile }}" class="form-control" id="email" />
                    </div>
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" {{$require_img}} />
                    </div>
    
                        
                    <!--div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details">التفاصيل </label>
                        <textarea name="details" id="editor1" class="form-control editor1" rows="3"  placeholder="اضف ..."></textarea>
                    </div>
                    <div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details_en">details_en </label>
                        <textarea name="details_en" class="form-control editor1" rows="3"  placeholder="Enter ..."></textarea>
                    </div-->
                        
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
    <?php 
    /*if (empty($cat->id))
    {
        echo '<button type="reset" class="btn btn-default">مسح</button>';
    }*/
    ?> 
                            
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
