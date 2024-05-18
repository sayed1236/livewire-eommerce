@extends('admin.layouts.app')

@section('content')
<div class="card card-custom">
    @include('includes.status_online')
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?></h3>
        </div>
    </div>
    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('includes.messages')
            </div>
@if (is_null($result) == 0)
<?php
$dis_sub='hidden';
$dis_img='hidden';
?>
<style>
.mso{
    font-size: 18px;
    color:purple
}
</style>
            <table  class="table table-bordered table-striped" style="text-align:center;font-size: 16px;" >
                <tr >
                    <th class="mso"> الاسم / name  </th>
                    <td >{{ $result->name}} </td>

                </tr>
                <tr class="d-none">
                    <th class="mso">الهاتف / mobile</th>
                    <td>{{ $result->mobile }}</td>
                </tr>

                <tr style="">
                    <th class="mso">الايميل / email </th>
                    <td>{{ $result->email}}</td>

                </tr>
                <tr class="{{$dis_img}} d-none">
                    <th class="mso "> الملف / file</th>
                    <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                </tr>
                <tr class="{{$dis_sub}}" >
                    <td class=" mso">الموضوع /subject </td>
                    <td > {!! $result->subject !!}  </td>
                </tr>
                <tr class="mso">
                    <td colspan="4">الرسالة  /message </td>
                </tr>
                <tr  rowspan="10">
                    <td  colspan="4" > {!! $result->message !!} <br/><br/> </td>
                </tr>

            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>

@endif

        </div>
    </div>
@endsection
