 @extends('admin.layouts.app')

@section('content')
<?php
use App\Models\product;
?>
 <script src="{{ url('admin/editor_html/ckeditor.js')}}"></script>
 <script src="{{ url('admin/editor_html/adapters/jquery.js')}}"></script>
    <script>
    $( document ).ready( function() {
        $( 'textarea.editor1' ).ckeditor();
    } );

    </script>
<div class="row">

    <div class="col-md-8 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header">
                    <h3 class="box-title" style="text-decoration: underline;color:brown">{!!$title!!} </h3>
                <!-- alert msg-->
                @include('includes.messages')
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>

              </div>
            </div>
            <div class="box-body pad">
                 <form @if (isset($result->id))
                        action="{{route('notifications.update', $result->id ) }}"
                    @else
                        action="{{route('notifications.store') }}"
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

                        <input type="hidden" name="type" value="{{ @$result->type}}" />
                        <input type="hidden" name="with_id" value="{{ @$result->with_id}}" />

                <div class="form-group hidden ">&nbsp; &nbsp; &nbsp;
                    <input type="checkbox" name="is_notification" value="1" class="minimal" checked="">
                  &nbsp; &nbsp; &nbsp;<label for="is_notification">ارسال كإشعار</label>
                </div>
                <div class="form-group col-md-6">
                  <label for="Name">الاسم</label>
                    <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder="" required=""  />
                </div>
                <div class="form-group col-md-6 ">
                  <label for="name_en">Name EN</label>
                  <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" id="name" placeholder=""  required=""  />
                </div>
                <div class="form-group col-md-6">
                  <label for="img">img</label>
                  <input type="file" name="img"   class="form-control" id="img" />
                </div>
<?php
if($result->type==1)
{
    $dis_author='hidden';
}
else
{
    $dis_author='hidden';
}
?>
                <div class="form-group col-md-6">
                    <label for="name_en">URL </label>
                    <input type="url" name="url_link" value="{{ @$result->url_link }}" class="form-control" id="name" placeholder=""  />
                </div>
                <div class="form-group col-md-6 hidden">
                  <label for="details_en">نبذه </label>
                  <textarea name="brief"  class="form-control" rows="3"  placeholder="Enter ...Brief AR" ><?php echo $result->brief; ?></textarea>
                </div>
                <div class="form-group col-md-6 hidden">
                  <label for="details_en">Brief EN</label>
                  <textarea name="brief_en"  class="form-control" rows="3"  placeholder="Enter ...Brief EN"><?php echo $result->brief_en; ?></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="details">التفاصيل </label>
                    <textarea name="details" id="editor13" class="form-control" rows="3"  placeholder="Enter ..."  required="" ><?php echo html_entity_decode($result->details); ?></textarea>

                </div>
                <div class="form-group col-md-12">
                  <label for="details_en">details_en </label>
                  <textarea name="details_en" id="editor23" class="form-control" rows="3"  placeholder="Enter ..."  required="" ><?php echo html_entity_decode($result->details_en); ?></textarea>
                </div>
                <div class="box-footer col-md-12">
                    <input type="submit" name="insert" class="btn btn-info pull-center" value="إرســـــــــال" />
                    <button type="reset" class="btn btn-default">مسح</button>
                    <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>

                </div><!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
