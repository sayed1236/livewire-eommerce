@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <p style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px ">{{ $title }}</b>
                    <a  href="{{route('users-requests.create',['type'=>$type])}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
                </p>
@if(Session::has('flash_message'))
    <div class="alert alert-success col-md-6 col-md-offset-3  alert-dismissable">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-ok"></span>   <em> {!! session('flash_message') !!}</em>
    </div>
@endif
            </div><!-- /.box-header -->
            <div class="box-body">
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>نوع الطلب </th>
                    <th>عدد الايام</th>
                    <th>السبب</th>
                    <th>المرفقات</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    <?php $i=1; ?>
    @foreach ($results as $result)
        
    
                    <tr>
                        <td>{{ $i }}</td>
                        <td><a>{{ $result->user_name.' '.$result->l_name}}</a></td>
                        <td>{{ $result->mobile}}</td>
                        <td>{{$result->request_type_name}}</td>
                        <td>{{ $result->num_days}} يوم</td>
                        <td>{{ cut_arabic_text($result->details , 350) }}</td>
                        <td>
                            @if (!empty($result->files))
                                <a href="{{ img_chk_exist($result->files) }}">اضغط للاطلاع </a>
                            @else
                                لا يوجد
                            @endif
                        </td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 11%">
<?php if($result->admin_view ==1){ $styl='warning';$act_w='تم الاطلاع'; }else{$styl='success'; $act_w='جــــديــــد';} ?>
                        <a href="{{route('users-requests.show',$result->id)}}" 
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('users-requests.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('users-requests.index')}}" onclick="
                                                            if(confirm('هل انت متأكد من الحذف؟')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }
                        
                        " class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
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
@endsection