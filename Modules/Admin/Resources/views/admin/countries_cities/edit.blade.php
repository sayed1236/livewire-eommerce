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
$dis_det='';
$dis_img='';
$dis_price='hidden';
if($result->parent_id>0 ){
    $dis_det='hidden';
    $dis_img='hidden';
    $dis_price='';
}
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
                        action="{{route('countries_cities.update', $result->id ) }}"
                    @else
                        action="{{route('countries_cities.store') }}"
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
 
                    <div class="form-group col-md-2  clearbox">
                        <label for="ord">Ord/الترتيب</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                        
                    <div class="form-group col-md-11">
                        <input type="hidden" name="type" value="{{ @$result->type}}" />        
                        <input type="hidden" name="parent_id" value="{{ @$result->parent_id}}" /> 
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" dir="ltr" value="{{ @$result->name_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6  {{$dis_det}}">
                        <label >كود العملة</label>
                        <input type="text" name="currency_code" value="{{ @$result->currency_code }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6  {{$dis_det}}">
                        <label >Currency Code EN</label>
                        <input type="text" name="currency_code_en" dir="ltr" value="{{ @$result->currency_code_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                     <div class="form-group col-md-6  {{$dis_det}}">
                        <label >مفتاح الدولة</label>
                        <input type="text" name="dail_code" value="{{ @$result->dail_code }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" />
                    </div>
                    
                    <div class="form-group col-md-6 col-md-offset-3 {{$dis_price}}">
                        <label>رسوم التوصيل</label>
                        <input type="number" name="price_move" min="0" dir="ltr" value="{{ @$result->price_move }}" class="form-control"  />
                    </div>
                    
                        
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
    <?php 
    /*if (empty($countries_cities->id))
    {
        echo '<button type="reset" class="btn btn-default">مسح</button>';
    }*/
    ?> 
                            
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>
                            
                    </div> 
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
