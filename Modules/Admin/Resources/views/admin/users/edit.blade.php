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
        $require_img='';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
        
    }elseif($type ==2){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='';
        $dis_gndr='';
        $dis_datb='';
        $dis_city='';
        
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
        $dis_gndr='';
        $dis_datb='';
        $dis_city='';
        
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
        
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
        
    }elseif($type ==6){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
        
    }else{
        $dis_det='hidden';
        $dis_img='';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
        $require_img='';
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
                    <div class="form-group col-md-6 hidden">
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
                    <div class="form-group col-md-6 {{ $dis_det }}">
                        <label for="ord">الموبايل</label>
                        <input type="text" name="mobile" value="{{ @$result->mobile }}" class="form-control"  <?php if($result->mobile==''){echo '';}else{ echo 'readonly=""';} ?> />
                    </div>
                    <div class="form-group col-md-6 {{@$dis_gndr}}">
                    <label for="name_en"> النوع</label>
                    <select  name="gender" class="form-control" dir="rtl" >
                        <option value="male" @if ($result->gender =='male') selected="" @endif >    ذكر    </option>
                        <option value="female"  @if ($result->gender =='female') selected="" @endif>    انثى    </option>
                    </select>                      
                    </div>
                    <div class="form-group col-md-6 {{@$dis_datb}}">
                        <label for="ord">تاريخ الميلاد</label>
                        <input type="date" name="date_birth" value="{{ @$result->date_birth }}" class="form-control" />
                    </div>
                    <div class="form-group col-md-6 {{@$dis_city}}">
                    <label for="name_en"> المدينة</label>
                    <select  name="city" class="form-control select2" dir="rtl" >
                        <option value="">    اختر    </option>
<?php
if(!is_null($city_results))
{
    foreach($city_results as $city_result)
    {
        if($result->city == $city_result->id)
        {
            $sel_l1='selected=""';
        }else{ $sel_l1='';}
?>
                    <option value="{{ $city_result->id }}" {{$sel_l1}}>{{ $city_result->name }}</option>
<?php
    }
}
?>
                    </select>                      
                    </div>
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" {{$require_img}} />
                    </div>

                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
