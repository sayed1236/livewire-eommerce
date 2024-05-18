@extends('admin.layouts.app')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
                    <h3 class="box-title" style="text-decoration: underline;color:brown">
  @if (isset($result->id))
    تعديــــــــــــل
@else
    
    إضـــــــــــــافة
@endif
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
                        action="{{route('related_links.update', $result->id ) }}"
                    @else
                        action="{{route('related_links.store') }}"
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
 
                        <input type="hidden" name="type" value="{{ @$result->type}}" />        
                        <input type="hidden" name="parent_id" value="{{ @$result->parent_id}}" /> 
                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" dir="ltr" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="ord">Ord/الترتيب</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-4 <?php //echo $dis_img; ?>">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" />
                    </div>
                    @if (count($cats))
    
                    <div class="form-group col-md-6">
                      <label for="">اختر القسم</label>
                      <select name="cat_id" class="form-control select2" required>
@foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @if($result->cat_id == $cat->id) selected="" @endif >{{ $cat->name }}</option>
@endforeach
                      </select>                      
                    </div>
    
    
@else
                    <input type="hidden" name="cat_id" value="{{ @$result->cat_id}}" />
@endif
                    <div class="form-group col-md-12">
                        <label for="details">url link </label>
                        <input type="url" name="url_link"  class="form-control" rows="2"  dir="ltr"  value="{{ @$result->url_link }}" required />
                    </div>
                    <div class="form-group col-md-12 hidden">
                        <label for="details">التفاصيل </label>
                        <textarea name="details" id="editor1" class="form-control editor1" rows="3"  placeholder="اضف ...">{{ @$result->details }}</textarea>
                    </div>
                    <div class="form-group col-md-12 hidden">
                        <label for="details_en">details_en </label>
                        <textarea name="details_en" class="form-control editor1" rows="3"  placeholder="Enter ...">{{ @$result->details_en }}</textarea>
                    </div>
                        
                    <div class="box-footer">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
    <?php 
    /*if (empty($related_links->id))
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
