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

                    <h3 class="box-title" style="text-decoration: underline;color:brown">
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
                        action="{{route('social_media.update', $result->id ) }}"
                    @else
                        action="{{route('social_media.store') }}"
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
@if (isset($type))
    <input type="hidden" name="type" value="{{$type}}" />
@else
    <input type="hidden" name="type" value="{{@$result->type}}" />
@endif

                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ord">Ord/الترتيب</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">i icon</label>
                        <input type="text" name="i_icon" value="{{ @$result->i_icon }}" class="form-control"   />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">class social</label>
                        <input type="text" name="class_so" value="{{ @$result->class_so }}" class="form-control"   />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">url social</label>
                        <input type="text" name="url_l" value="{{ @$result->url_l }}" class="form-control"   />
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
