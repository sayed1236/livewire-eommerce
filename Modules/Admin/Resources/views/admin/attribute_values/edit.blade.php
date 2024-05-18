@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header">
             <label style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px ">{!! $title !!}</b>
            </label>
                <!-- alert msg-->
                @include('includes.messages')
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body pad">
                    <form action="{{route('attribute_values.update', $result->id ) }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    <div class="form-group col-md-9 clearbox">
                        <input type="hidden" name="attribute_id" value="{{ @$result->attribute_id}}" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  required=""/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" dir="ltr" value="{{ @$result->name_en }}" class="form-control" id="name_en" required=""  />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="Name">إضافة قيمة</label>
                        @if ($result->attribute_id == 1)
                            <input type="color" name="value" value="{{ @$result->value }}" class="form-control" id="name" placeholder=""  />
                        @else
                            <input type="text" name="value" value="{{ @$result->value }}" class="form-control" id="name" placeholder=""  />
                        @endif
                        
                    </div>
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="حفـــظ" />
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
      </section>
      <section class="content">
   
     </div>
     </section>
    
@endsection