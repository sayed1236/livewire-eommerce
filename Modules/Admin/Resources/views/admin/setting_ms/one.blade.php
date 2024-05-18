@extends('admin::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12">
@if (is_null($result)== 0)
<?php
    if($result->id ==1){
        $dis_det='';
        $dis_img='';
    }elseif($result->id ==2){
        $dis_det='';
        $dis_img='';
    }elseif($result->id ==3){
        $dis_det='';
        $dis_img='';
    }elseif($result->id ==4){
        $dis_det='';
        $dis_img='';
    }elseif($result->id ==5){
        $dis_det='';
        $dis_img='';
    }else{
        $dis_det='';
        $dis_img='';
    }

    ?>
        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center">
                    <b style="font-size: 18px;color:red"> <center>
                    الصفحات المقالية
                   </center> </b>
                </label>
            </div>
            <div class="box-body">
            <table  class="table table-bordered table-striped" style="text-align:center;font-size: 16px;" >
                <tr style="font-size: 18px;color:purple">
                    <th class="col-md-6"> الاسم / name En </th>
                    <th class="col-md-3 {{$dis_img}}"> الصورة</th>
                    <th class="">تاريخ اخر تعديل</th>
                    <th class=""> الاجراء</th>

                </tr>
                <tr>
                    <td>{{ $result->name}} <br/> {{ $result->name_en}}</td>
                    <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                    <td>{{ $result->created_at }}</td>
                    <th>
                    <!---------- edit Button --->
                    <a href="{{ route('static_page.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                    </th>
                </tr>
                <tr class="{{$dis_det}}" style="font-size: 18px;color:purple">
                    <td colspan="4">التفاصيل </td>
                </tr>
                <tr class="{{$dis_det}}" rowspan="10">
                    <td  colspan="4" > {!! $result->details !!} <br/><br/> </td>
                </tr>
                <tr class="{{$dis_det}}" style="font-size: 18px;color:purple">
                    <td colspan="4">details En</td>
                </tr>
                <tr class="{{$dis_det}}" rowspan="10">
                    <td  colspan="4" > {!! $result->details_en !!} </td>
                </tr>
            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>

@endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
