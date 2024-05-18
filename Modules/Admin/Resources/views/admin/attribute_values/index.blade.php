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
                <form action="{{route('attribute_values.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    <div class="form-group col-md-9 clearbox">
                        <input type="hidden" name="attribute_id" value="{{ @$attribute_id}}" />
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
                        @if ($attribute_id == 1)
                            <input type="color" name="value" value="" class="form-control" id="name" placeholder=""  />
                        @else
                            <input type="text" name="value" value="" class="form-control" id="name" placeholder=""  />
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
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <div class="box-body">

@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="padding: 1px;width: 5%"># </th>
                    <th>الاسم</th>
                    <th>القيمة</th>
                    <th style="padding: 1px;width: 15%">التاريح</th>
                    <th style="padding: 1px;width: 12%">Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
<?php  $ii=1; ?>
    @foreach ($results as $result)
        
    
                    <tr>
                        <td>{{$ii}}</td>
                        <td>{!! $result->name.'<br/>'.$result->name_en !!}</td>
                        <td><a>
                        @if ($attribute_id == 1)
                            <input type="color" name="value" value="{!! $result->value !!}" class="form-control" style="width:100%" readonly=""  />
                        @else
                            {!! $result->value !!}
                        @endif
                        
                        
                        </a></td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 14%">
                        <!---------- edit Button --->
                        <a href="{{ route('attribute_values.edit',$result->id) }}" class="btn btn-primary" style="padding: 6px 1px;">تعديل<i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('attribute_values.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('attribute_values.index')}}" onclick="
                                                            if(confirm('هل انت متأكد من الحذف؟')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }
                        
                        " class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
                        </td>
                    </tr>
    <?php  $ii++; ?> @endforeach
                </tfoot>
            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>
    
@endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
     </div>
     </section>
    <script src="{{url('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
@endsection