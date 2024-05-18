@extends('admin.layouts.app')
@section('title')
    {{$title}}
@endsection

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
                    <h3 class="box-title" style="text-decoration: underline;color:brown"> </h3>
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
            <div class="form-group">
@if (isset($result->id) && !empty($result->tax_num_file))
                    <div class="col-md-6">
                        <label>صورة البطاقة الضريبية</label>
                        <img src="{{ img_chk_exist($result->tax_num_file)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
@if (isset($result->id) && !empty($result->commercial_num_file))
                    <div class="col-md-6">
                        <label>صورة السجل التجارى</label>
                        <img src="{{ img_chk_exist($result->commercial_num_file)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
                </div>
                <form @if (isset($result->id))
                        action="{{route('user_details.update', $result->id ) }}"
                    @else
                        action="{{route('user_details.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif    
                    <input type="hidden" name="user_id" value="{{ @$result->user_id}}" /> 
                    <div class="form-group col-md-6">
                        <label for="Name">اسم المورد</label>
                        <input type="text"  value="{{ @$get_users->name.' '.@$get_users->mid_name.' '.@$get_users->l_name }}" class="form-control" readonly="" disabled=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Name">اسم المنشأة</label>
                        <input type="text" name="facility_name" value="{{ @$result->facility_name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label >الهاتف</label>
                        <input type="text" name="tel" value="{{ @$result->tel }}" class="form-control" id="name_en" placeholder=""  />
                    </div>  
                    <div class="form-group col-md-6">
                        <label >الموقع الالكترونى</label>
                        <input type="text" name="website" value="{{ @$result->website }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label >الرقم الضريبى</label>
                        <input type="text" name="tax_number" value="{{ @$result->tax_number }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label>صورة البطاقة الضريبية</label>
                        <input type="file" name="tax_num_file"  class="form-control"  />
                    </div> 
                    <div class="form-group col-md-6">
                        <label >السجل التجارى</label>
                        <input type="text" name="commercial_number" value="{{ @$result->commercial_number }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="img">صورة السجل التجارى</label>
                        <input type="file" name="commercial_num_file"  class="form-control"   />
                    </div> 
                    <div class="form-group col-md-12 <?php //echo $dis_det; ?>">
                        <label for="details">ملاحظات </label>
                        <textarea name="notes"  class="form-control editor1" rows="3"  placeholder="اضف ...">{{ @$result->notes }}</textarea>
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
