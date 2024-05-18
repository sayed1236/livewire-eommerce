@extends('admin.layouts.app')

@section('content')
<?php use App\Models\countries_citie; ?>
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center">
                    <b style="float:right;font-size: 18px ">{{$title}} </b>
                    <a  href="{{route('users.create',['type'=>$type])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
                </label>
 <!-- alert msg-->
                @include('includes.messages')
            </div>
            <div class="box-body" style="overflow-y: scroll;">
  <?php
if (isset($type)):
    if($type ==1){
        $dis_det='';
        $dis_img='';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }elseif($type ==2){
        $dis_det='';
        $dis_img='hidden';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }elseif($type ==6){
        $dis_det='hidden';
        $dis_img='hidden';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }else{
        $dis_det='hidden';
        $dis_img='';
        $dis_gndr='hidden';
        $dis_datb='hidden';
        $dis_city='hidden';
    }

endif;
?>
@if (count($results))
            <ul class="pagination">
                <li class="page-item active"><a class="page-link" >Total: {{ $results->total() }}</a></li>
            </ul>
            {{ $results->links() }}
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th> EN Name</th>
                    <th  class="{{$dis_det}}">mobile / tel</th>
                    <th>email</th>
                    <th class="{{$dis_img}}">IMG</th>
                    <th class="{{$dis_gndr}}">النوع</th>
                    <th class="{{$dis_gndr}}">الجنسية</th>
                    <th class="{{$dis_datb}}">تاريخ الميلاد</th>
                    <th class="{{$dis_city}}">المدينة</th>
                    <th>date add</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php $i=1; ?>
    @foreach ($results as $result)


                    <tr>
                        <td>{{$i}}</td>
                        <td><a <?php // echo @$go_url; ?> >{{ $result->name.' '. $result->mid_name.' '.$result->l_name}}</a>  </td>
                        <td class="{{$dis_det}}">{{ $result->mobile}}</td>
                        <td >{{ $result->email }}</td>
                        <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->img) }}" style="width: 90px; height: 80px;border-radius:15px" /></td>
                        <td class="{{$dis_gndr}}">{{ $result->gender }}</td>
                        <td class="{{$dis_gndr}}">{{ $result->nationality }}</td>
                        <td class="{{$dis_datb}}" style="padding: 1px;width: 7%">{{ $result->date_birth }}</td>
                        <td class="{{$dis_city}}">
@if($result->city >0 || $result->city !=null)
<?php
$city=@countries_citie::select('name')->find($result->city);
echo @$city->name;
?>

@endif
                        </td>
                        <td style="padding: 1px;width: 7%">{{ $result->created_at }}</td>
                        <td style="padding: 7px 1px;width: 14%">
@if ($result->id >2)
@if ($result->is_confirmed ==0)
                            <!-- -------- confirm  Button --->
                            <form id="confirm_ms-form-{{ $result->id }}" action="{{ route('users.confirmed_ms', $result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="{{route('users.index')}}" onclick="event.preventDefault();
                                        document.getElementById('confirm_ms-form-{{ $result->id }}').submit(); "
                            class="btn bg-purple" style="padding: 7px 11px;font-weight: bolder">تفعيل عضوية المستخدم</a>
                            <br/>


@endif
                            <!---------- active & Dis active Button --->
                            <form id="active_ms-form-{{ $result->id }}" action="{{ route('users.active_ms', $result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('PUT')
                            </form>
    <?php if($result->is_active ==1){ $styl='success';$act_w='نشـــــط'; }else{$styl='warning'; $act_w='غيرنشط';} ?>
                            <a href="{{route('users.index')}}" onclick="event.preventDefault();
                                        document.getElementById('active_ms-form-{{ $result->id }}').submit(); "
                            class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                            <!---------- edit Button --->
                            <a href="{{ route('users.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                            <!---------- delete Button --->
                            <form id="delete-form-{{ $result->id }}" action="{{ route('users.destroy',$result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{route('users.index')}}" onclick="if(confirm('هل انت متأكد من الحذف؟')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $result->id }}').submit();
                            }else{ event.preventDefault(); }"
                            class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
@else
<b>عفوا لا يمكن حذف هذا العضو </b>
@endif
                        </td>
                    </tr>
                    <?php $i++; ?>
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
