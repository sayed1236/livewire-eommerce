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
if (isset($result->type) && $result->type>0 ){ $type=$result->type; }
    $dis_file='hidden';
    $editor='editor1';
    if($type ==1){
        $dis_det='';
        $dis_img='';
        $require_img='required';
    }else{
        $dis_det='';
        $dis_img='';
        $require_img='required';
    }
    if (isset($result->id)){
        $require_img='';
    }
    ?>
                    <h3 class="box-title" style="text-decoration: underline;color:brown">
@if (isset($result->id))

       <strong>{{ trans('ms_lang.btn_edit') }} </strong> :<b style="color:blueviolet">{{$result->name}}</b>

@else

{{ trans('ms_lang.btn_add_new') }} /  {!! $title !!}

@endif
                    </h3>
                <!-- alert msg-->
                
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body pad">
                
                @include('includes.messages')
@if (isset($result->id))
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group  {{$dis_img}}">
                        <label for="ord"> Main Image</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 120px; height: 90px" />
                    </div>
@endif
<?php
if(count($img_gts))
{
?>
                    <div class="form-group ">
                        <label for="ord"class="col-md-12" > Pictures</label>
<?php foreach($img_gts as $img_gt)
    {
?>
                        <div class="col-md-3"> <img src="{{ img_chk_exist($img_gt->img)}}" style="width: 100%; height: 90px" />
                        <br/>
                        <form id="delete-form-{{ $img_gt->id }}" action="{{ route('portfolios.destroyimg',$img_gt->id)}}" method="post" style="display:none">
                            @csrf
                            @method('PUT')
                        </form>
                        <a href="{{route('portfolios.index')}}" onclick="if(confirm('are you sure delete it ?')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $img_gt->id }}').submit();
                                            }else{ event.preventDefault(); }" class="btn btn-danger">
                            <i class="glyphicon glyphicon-remove glyphicon-white"></i> delete</a>
                        </div>
<?php  } ?>
                    </div>
                    <div class="clearfix col-md-12">&nbsp;<hr style="color:red;font-size:20px"/> </div> 
<?php
}
?> 
@endif

                <form @if (isset($result->id))
                        action="{{route('portfolios.update', $result->id ) }}"
                    @else
                        action="{{route('portfolios.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    

                        <input type="hidden" name="type" value="{{@$result->type}}" />        
                         

                    <div class="form-group col-md-6">
                        <label for="Name">Project Name </label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" required=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Client Name</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" dir="ltr"  />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ord">Order</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="details">View in home</label>
                        <select name="view_in_home" class="form-control">
                            <option value="1" @if ($result->view_in_home == '1' ) selected="" @endif> yes</option>
                            <option value="0"  @if ($result->view_in_home == '0' ) selected="" @endif> no </option>
                        </select>
                    </div>
                    
@if (count($cats))
    
                    <div class="form-group col-md-6">
                      <label for="">Project Type</label>
                      <select name="cat_id" class="form-control select2" required>
                        <option value="0">    select    </option>
@foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @if($result->cat_id == $cat->id) selected="" @endif >{{ $cat->name }}</option>
@endforeach
                      </select>                      
                    </div>
    
    
@else
                    <input type="hidden" name="cat_id" value="{{ @$result->cat_id}}" />
@endif
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">Main Image</label>
                        <input type="file" name="img"  class="form-control" id="img"  {{$require_img}} />
                    </div>
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">Pictures</label>
                        <input type="file" name="imgs[]"  class="form-control" id="imgs" multiple  />
                    </div>
                    <div class="form-group col-md-12 <?php echo @$dis_det; ?>">
                        <label for="details">Project Description : (please only only keep one font ) </label>
                        <textarea name="details"  class="form-control {{ $editor }}" rows="3"  placeholder="اضف ...">{{ @$result->details }}</textarea>
                    </div>
                    <div class="form-group col-md-12 <?php echo @$dis_det; ?>">
                        <label for="details_en">Video Link</label>
                        <textarea name="details_en" class="form-control" rows="3"  dir="ltr" placeholder="Enter ...">{{ @$result->details_en }}</textarea>
                    </div>
                        
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="{{ trans('ms_lang.btn_save') }}" />
    <?php 
    /*if (empty($cat->id))
    {
        echo '<button type="reset" class="btn btn-default">مسح</button>';
    }*/
    ?> 
                            
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">{{ trans('ms_lang.btn_return') }}</button>
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
