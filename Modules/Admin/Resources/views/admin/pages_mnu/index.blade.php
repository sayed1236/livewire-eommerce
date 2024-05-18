@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">

    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center">
                    <b style="float:right;font-size: 18px ">
                    <?php echo $title; ?>

    <?php //$parent_g=$this->pages_mnu_M->get($p_id,true);
    //if(count($parent_g)) echo '( اضف فـ <em style="color: red;">'.$parent_g->name.'</em>)'; ?>
                    </b>
<?php //echo site_url(config('app.url_admin').'pages_mnu/Edit/'.$p_id.'/'.$t); ?>
                    <a  href="{{route('pages_mnu.create',['p_id'=>$parent_id])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
                </label>

            <div class="pull-right box-tools">
                <a href="{{url(config('app.url_admin').'pages_mnu/t/0') }}"><button type="button" class="btn btn-info btn-sm" >
                  <i class="fa fa-home"></i></button></a>
              </div>
            </div>
            <div class="box-body">

@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>EN Name</th>
                    <th class="<?php //echo $dis_img; ?>">IMG/الصورة</th>
                    <th class="<?php //echo $dis_det; ?>">url</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($results as $result)


                    <tr>
                        <td>{{$result->ord}}</td>
    <?php
    if( $result->parent_id==0)
    {
        $go_url='href="'.url(config('app.url_admin').'pages_mnu/t/'.$result->id).'"';
        $btn_ad='   <button class="btn btn-info" style="padding: 7px 0;">  اضـــف</button>';
    }
    else
    {
        $p_id=$result->parent_id;$btn_ad='';
    }
    ?>
                        <td><a <?php echo @$go_url; ?> >{{ $result->name}}</a></td>
                        <td>{{ $result->name_en}}</td>
                        <td >{{ $result->page_url }}</td>
                        <td >{!! $result->img !!}</td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 22%">
                        <a {!!@$go_url!!}>{!!$btn_ad!!}</a>
                        <!---------- active & Dis active Button --->
                        <form id="active_ms-form-{{ $result->id }}" action="{{ route('pages_mnu.active_ms', $result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('PUT')
                        </form>
<?php if($result->is_active =='Y'){ $styl='success';$act_w='نشـــــط&nbsp;'; }else{$styl='warning'; $act_w='غيرنشط';} ?>

                        <a href="{{route('pages_mnu.index')}}" onclick="event.preventDefault();
                                    document.getElementById('active_ms-form-{{ $result->id }}').submit(); "
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">{!! $act_w !!}</a>
                        <!---------- edit Button --->
                        <a href="{{ route('pages_mnu.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('pages_mnu.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('pages_mnu.index')}}" onclick="
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
