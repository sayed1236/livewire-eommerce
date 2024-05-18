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
        <div class="col-md-6 col-md-offset-3">
          <div class="box box-info">
            <div class="box-header">
                    <h3 class="box-title" style="text-decoration: underline;color:brown">
@if (isset($result->id))

       <strong>edit </strong> :<b style="color:blueviolet">{{$result->name}}</b>

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

                <form @if (isset($result->id))
                        action="{{route('NumbersWorks.update', $result->id ) }}"
                    @else
                        action="{{route('NumbersWorks.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif

                    <div class="form-group col-md-12">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" required=""  />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" dir="ltr"  />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="ord">Number</label>
                        <input type="number" name="number" value="{{ @$result->number }}" min="0" class="form-control"  />
                    </div>
                    
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
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
