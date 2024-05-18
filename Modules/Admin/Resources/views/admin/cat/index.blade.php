@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">

    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <p style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px ">{!! $title !!}</b>
                    <a  href="{{route('cat.create',['type'=> $type , 'parent_id' => $parent_id ])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">{{ trans('ms_lang.btn_add_new') }}
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>                 
                </p>
                <center>
@include('includes.messages')
                </center>
            </div>
            <div class="box-body">
    <?php
    $btn_titl='';
    $dis_feld_ms='hidden';
    if($type ==1){
        $dis_det='hidden';
        $dis_img='hidden';
        $btn_titl='portfolio';
    }elseif($type ==2){
        $dis_det='hidden';
        $dis_img='hidden';
        $btn_titl=' المحتوي بالقسم';
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
        $btn_titl='';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='';
        $btn_titl='';
    }elseif($type ==5){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($type ==6){
        $dis_det='hidden';
        $dis_img='hidden';
    }else{
        $dis_det='';
        $dis_img='';
    }
    ?>
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>EN Name</th>
                    <th class="{{$dis_img}}">IMG/الصورة</th>
                    <th class="{{$dis_det}}">details/التفاصيل</th>
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
                        <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                        <td class="{{$dis_det}}">{{ cut_arabic_text($result->details , 350) }}</td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 22%">
@if ($result->type == 1 && $result->parent_id ==0)
                        <a href="{{route('portfolios.t',['type'=> $result->type , 'cat_id' => $result->id ])}}"><button class="btn btn-info" style="padding: 7px 0;"> {{$btn_titl}}</button></a>
@elseif (($result->type == 2 ) && $result->parent_id ==0)
                        <a href="{{route('art_min.t',['type'=> $result->type , 'cat_id' => $result->id ])}}"><button class="btn btn-info" style="padding: 7px 0;"> {{$btn_titl}}</button></a>

{{-- @elseif ($result->type == 4 && $result->parent_id ==0)
                        <a href="{{route('related_links.t',['type'=> $result->type , 'cat_id' => $result->id ])}}"><button class="btn btn-info" style="padding: 7px 0;"> {{$btn_titl}}</button></a> --}}
@endif

@if ($result->type ==5 && $result->parent_id ==0)
                          <a href="{{route('cat.t',['type'=> $result->type , 'parent_id' => $result->id ])}}"><button class="btn btn-info" style="padding: 7px 0;">  الاقسام الفرعية</button></a>
@endif
@if(Auth::user()->user_level > 3 || $result->parent_id > 0)
                      
                        <!---------- active & Dis active Button --->
                        <form id="active_ms-form-{{ $result->id }}" action="{{ route('cat.active_ms', $result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('PUT')
                        </form>
                        <?php if($result->is_active ==1){ $styl='success';$act_w=__('ms_lang.active'); }else{$styl='warning'; $act_w=__('ms_lang.disactive');} ?>

                        <a href="{{route('cat.index')}}" onclick="event.preventDefault();
                                    document.getElementById('active_ms-form-{{ $result->id }}').submit(); " 
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                        <!---------- edit Button --->
                        <a href="{{ route('cat.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('cat.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('cat.index')}}" onclick="
                                                            if(confirm('هل انت متأكد من الحذف؟')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }
                        
                        " class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
                            
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