@extends('admin.layouts.app')

@section('content')
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title" style="text-decoration: underline;color:brown"> 
                    @if (isset($result->id))
                    {{ trans('ms_lang.btn_edit') }}
                    @else
                        
                    {{ trans('ms_lang.btn_add_new') }}
                    @endif
                     :=> {{ @$title }}
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
                        action="{{route('galleries.update', $result->id ) }}"
                    @else
                        action="{{route('galleries.store') }}"
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
                        <input type="hidden" name="cat_id" value="{{ @$result->cat_id}}" /> 
                    <div class="form-group col-md-6">
                        <label for="Name">{{ __('ms_lang.input_name') }}</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">Ord</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-6 <?php //echo $dis_img; ?>">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" />
                    </div>
    
                    <div class="box-footer">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="{{ trans('ms_lang.btn_save') }}" />
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">{{ trans('ms_lang.btn_return') }}</button>
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
