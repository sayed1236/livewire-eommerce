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
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header">
    <?php
    if($result->type ==1){
        $dis_det='';
        $dis_img='';
    }elseif($result->type ==2){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($result->type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($result->type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($result->type ==5){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($result->type ==6){
        $dis_det='hidden';
        $dis_img='hidden';
    }else{
        $dis_det='';
        $dis_img='';
    }
    //if($result->parent_id>0 ){
    //    $dis_det='';
    //    $dis_img='';
    //}
    ?>

                    <h3 class="box-title" style="text-decoration: underline;color:brown">
    <?php 
    if (!empty($result->id))
    {
        echo '<strong>تعديل</strong> :<b style="color:blueviolet">'.$result->name.'</b>';
        $btn_kw='تعديــــــل';
    }else
    {
        echo 'اضــــــافة جديد/ '.$title;
        $btn_kw='اضافة جديد';
    }
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
                        action="{{route('albums.update', $result->id ) }}"
                    @else
                        action="{{route('albums.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group <?php //echo $dis_img; ?>">
                        <label for="ord">الصورة</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
 
                        
                    <div class="form-group col-md-9 clearbox">
                        <input type="hidden" name="type" value="{{ @$result->type}}" />        
                        <input type="hidden" name="parent_id" value="{{ @$result->parent_id}}" /> 
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" dir="ltr" value="{{ @$result->name_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-4 {{$dis_img}}">
                        <label for="img">cover photo</label>
                        <input type="file" name="cover_photo"  class="form-control"  />
                    </div>
                    <div class="form-group col-md-4 {{$dis_img}}">
                            <label for="img">img</label>
                            <input type="file" name="img"  class="form-control" id="img" />
                    </div>
@if ($result->type == 0)
                    <div class="form-group col-md-4">
                        <label for="ord">Year/العام</label>
                        <select name="year" class="form-control">
                            <option value="">  اختر</option>
    @for ($year = date('Y')-20; $year <= date('Y')+1; $year++)
                            <option value="{{$year}}" @if($result->year == $year) selected="" @endif>{{$year}}</option>
    @endfor
                        </select>
                    </div>
@else
                    <div class="form-group col-md-4">
                        <label for="name_en">التاريخ </label>
                        <input type="date" name="date"  value="{{ @$result->date }}" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Name">العنوان</label>
                        <input type="text" name="address" value="{{ @$result->address }}" class="form-control"  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Address EN</label>
                        <input type="text" name="address_en" dir="ltr" value="{{ @$result->address_en }}" class="form-control"  />
                    </div>
                    

@endif
                        

                    <div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details">التفاصيل </label>
                        <textarea name="details" id="editor1"  dir="rtl" class="form-control editor1" rows="3"  placeholder="اضف ...">{{ @$result->details }}</textarea>
                    </div>
                    <div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details_en">details_en </label>
                        <textarea name="details_en"  dir="ltr" class="form-control editor1" rows="3"  placeholder="Enter ...">{{ @$result->details_en }}</textarea>
                    </div>
                        
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
