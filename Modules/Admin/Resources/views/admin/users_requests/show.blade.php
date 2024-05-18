@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12">
@if (is_null($result) == 0)
<?php
$dis_sub='';
$dis_img='';
?>
<style>
.mso{
    font-size: 18px;
    color:purple
}
</style>
        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center"> 
                    <b style="font-size: 18px;color:red"> <center>
                    {{$title}} 
                    @if ($result->restaurant_branche_name <>null)
                    {{$result->restaurant_branche_name}}
                @else
                {{ $result->restaurant_name}} 
                @endif
                   </center> </b>
                </label>
            </div>
            <div class="box-body">
            <table  class="table table-bordered table-striped" style="text-align:center;font-size: 16px;" >
                <tr >
                    <th class="col-md-3 mso"> الاسم / name  </th>
                    <td>{{ $result->user_name}} </td>
                    
                </tr>
                <tr >
                        <th class="col-md-3 mso"> موبايل / mobile  </th>
                        <td>{{ $result->user_mobile}} </td>
                        
                </tr>
                <tr>
                    <th class="mso">الدولة </th>
                    <td>{{ $result->country_name}}</td>
                </tr>

                <tr style="">
                    <th class="mso">المدينة </th>
                    <td>{{ $result->city_name}}</td>
                    
                </tr>
                <tr>
                    <th class="mso "> اللوجو / logo</th>
                    <td><img src="{{ img_chk_exist($result->logo) }}" style="width: 70px; height: 60px" /></td>
                </tr>
                <tr>
                        <th class="mso "> البانر / banner</th>
                        <td><img src="{{ img_chk_exist($result->banner) }}" style="width: 70px; height: 60px" /></td>
                    </tr>
                    <tr> 
                    <td class=" mso">تفاصيل المطعم /restaurant details </td>
                    <td > {!! $result->restaurant_details !!}  </td>
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