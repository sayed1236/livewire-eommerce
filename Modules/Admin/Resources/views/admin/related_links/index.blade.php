@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">

    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px ">{!! $title !!}</b>
                    <a  href="{{route('related_links.create',['type'=>$type,'cat_id'=>$cat_id])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
                </label>

            <!-- alert msg
            <div class="alert alert-<?php echo @$alert_clas; ?> alert-dismissable" style="width: 40%;margin-left: 30%;display:<?php //echo $dis_alert; ?> ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?php //echo @$alert_msg; ?></h4>
            </div>-->
        <!--end alert msg-->
            </div><!-- /.box-header -->
            <div class="box-body">
    
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>EN Name</th>
                    <th>IMG/الصورة</th>
                    <th>الرابط</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($results as $result)
                    <tr>
                        <td>{{$result->ord}}</td>
                        <td><a <?php // echo @$go_url; ?> >{{ $result->name}}</a></td>
                        <td>{{ $result->name_en}}</td>
                        <td><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                        <td><a href="{{ $result->url_link}}" >{{ $result->url_link}}</a></td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 22%">
                       <!---------- active & Dis active Button --->
                        <form id="active_ms-form-{{ $result->id }}" action="{{ route('related_links.active_ms', $result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('PUT')
                        </form>
<?php if($result->is_active ==1){ $styl='success';$act_w='نشـــــط'; }else{$styl='warning'; $act_w='غيرنشط';} ?>

                        <a href="{{route('related_links.index')}}" onclick="event.preventDefault();
                                    document.getElementById('active_ms-form-{{ $result->id }}').submit(); " 
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                        <!---------- edit Button --->
                        <a href="{{ route('related_links.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('related_links.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('related_links.index')}}" onclick="
                                                            if(confirm('هل انت متأكد من الحذف؟')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }
                        
                        " class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
                           
                        </td>
                    </tr>
    @endforeach
                </tfoot>
            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>
    
@endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
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