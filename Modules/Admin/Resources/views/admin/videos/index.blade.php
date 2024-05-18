@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <p style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px "> {!! $title !!}</b>
@if ($type > 1)
                    <a  href="{{route('videos.create',['type'=>$type,'cat_id'=>$cat_id])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
@endif
                    
                </p>
@include('includes.messages')
            </div>
            <div class="box-body" style="overflow-y: scroll;">
  <?php
if (isset($type)):
    if($type ==1){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($type ==2){
        $dis_det='';
        $dis_img='';
    }elseif($type ==3){
        $dis_det='';
        $dis_img='';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='';
    }else{
        $dis_det='';
        $dis_img='';
    }

endif;
?>
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم / EN Name</th>
                    <th class="{{$dis_img}}">IMG/الصورة</th>
                    <th class="">الفيديو</th>
                    <th class="{{$dis_det}}">details/التفاصيل</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($results as $result)
        
    
                    <tr>
                        <td>{{$result->ord}}</td>
                        <td><a <?php // echo @$go_url; ?> >{{ $result->name}}</a>
                            <br/><br/>{{ $result->name_en}}
                        </td>
                        <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                        <td class=""> {!! $result->video_url !!} </td>
                        <td class="{{$dis_det}}">{!! cut_arabic_text($result->details , 350) !!}</td>
                        <td style="padding: 1px;width: 7%">{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 14%">
                            <!---------- active & Dis active Button --->
                            <form id="active_ms-form-{{ $result->id }}" action="{{ route('videos.active_ms', $result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('PUT')
                            </form>
    <?php if($result->is_active ==1){ $styl='success';$act_w='نشـــــط&nbsp;'; }else{$styl='warning'; $act_w='غيرنشط';} ?>
@if ($type > 1)
                            <a href="{{route('videos.index')}}" onclick="event.preventDefault();
                                        document.getElementById('active_ms-form-{{ $result->id }}').submit(); " 
                            class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">{!! $act_w !!}</a>
@endif
                            <!---------- edit Button --->
                            <a href="{{ route('videos.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
@if ($type > 1)
                            <!---------- delete Button --->
                            <form id="delete-form-{{ $result->id }}" action="{{ route('videos.destroy',$result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{route('videos.index')}}" onclick="if(confirm('هل انت متأكد من الحذف؟')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $result->id }}').submit();
                            }else{ event.preventDefault(); }" 
                            class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
@endif
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
    </div><!-- /.row -->
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