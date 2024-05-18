@extends('admin.layouts.app')

@section('content')
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
            </div>
            <div class="box-body" style="overflow-y: scroll;">
  <?php
if (isset($type)):
    if($type ==1){
        $dis_det='';
        $dis_img='';
    }elseif($type ==2){
        $dis_det='';
        $dis_img='hidden';
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
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
                    <th> </th>
                    <th>رقم الطلب</th>
                    <th>بيانات العميل</th>
                    <th>بيانات الدفع</th>
                    <th>عنوان الطلب</th>
                    <th>هاتف الاوردر</th>
                    <th>تاريخ الطلب</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
<?php $i=1; ?>
    @foreach ($results as $result)
        
    
                    <tr>
<?php
if($result->status== '' || $result->status=='new'){
    $admin_view="&nbsp;طلب جديــــد";
    $color="color:white; background-color:green";
    $deliver_kw='step=new';
}elseif($result->status =='working'){
    $admin_view="جارى التحضير";
    $color="color:white; background-color:#00c0ef;";
    $deliver_kw='';
}elseif($result->status=='delivering'){
    $admin_view="&nbsp;جارى توصيلة";
    $color="color:white; background-color:#f39c12;";
    $deliver_kw='';
}elseif($result->status=='finished'){
    $admin_view="&nbsp;تــــــم توصيلة";
    $color="color:#ff0084; background-color:silver";
    $deliver_kw='';
}else{
    $admin_view="&nbsp;تــــــم توصيلة";
    $color="color:green; background-color:silver";
    $deliver_kw='';
}
?>
                        <td>{{$i}}</td>
                        <td><a href="{{ route('user_orders.show',['id'=>$result->id , $deliver_kw ]) }}" >{{$result->order_num}}</a></td>
                        <td dir="rtl" style="margin: 7px 0;">
                        الاسم: <a >{{ $result->name.' '. $result->mid_name.' '.$result->l_name }}</a><br/>
                        الهاتف  : {{ $result->userMobile }}<br/>
                        الايميل: {{$result->userEmail}}
                        </td>
                        
                        <td dir="rtl" style="margin: 7px 0;">
                        نوع الدفع: @if($result->payment_type == 1) كريدت كارد @else كاش @endif <br/>
                        السعر  :  <a>{{$result->order_total_price}} </a> ريال<br/>
                        سعر التوصيل  :  <a>{{$result->price_move}} </a> ريال<br/>
                        
                        </td>
                        <td dir="rtl" style="margin: 7px 0;">
                            المدينة: {{$result->city}}<br/>
                            المنطقة : {{$result->region}}<br/>
                            الشارع : {{$result->street}}<br/>
                            رقم البناية : {{$result->building}}<br/>
                            {{-- رقم الطابق : {{$result->floor_num}}<br/> --}}
                            رقم الشقة : {{$result->apartment}}<br/>
                            
                        </td>
                        <td dir="rtl" style="margin: 7px 0;">
                        هاتف الاورد: {{$result->telephone}}<br/>
                        موبايل الاوردر  : {{$result->mobile}}<br/>
                        </td>
                        <td style="padding: 1px;width: 8%">{{$result->created_at}}</td>
                        <td style="padding: 0px;width: 12%">
                            <!---------- edit Button --->
                                <a href="{{ route('user_orders.show',['id'=>$result->id , $deliver_kw ]) }}" class="btn btn-success" style="padding: 7px 1px;font-weight: bolder;{!!$color!!}">{!!$admin_view!!}</a>
                            <!---------- delete Button --->
                            <form id="delete-form-{{ $result->id }}" action="{{ route('user_orders.destroy',$result->id)}}" method="post" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{route('user_orders.index')}}" onclick="if(confirm('هل انت متأكد من الحذف؟')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $result->id }}').submit();
                            }else{ event.preventDefault(); }" 
                            class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
@if(empty($result->aramex_moving_order_id) || $result->aramex_moving_order_id == '')
                            <a href="{{ route('aramex_shipments.create',['order_id' => $result->id , 'type' => $result->type ]) }}">
                              <button class="btn btn-warning btn-sm"  style="font-size: 16px;padding-right:1px;padding-left:0px">انشاء امر توصيل<i class="fa fa-fw fa-truck"></i></button>
                            </a>
@else
                             <a href="{{@$result->aramex_moving_pdf}}" target="_blank">
                                <button class="btn btn-primary btn-sm" style="font-size: 16px;" >امر التوصيل:<br/> {{$result->aramex_moving_order_id}}</button> 
                             </a>               
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