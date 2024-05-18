@extends('admin::admin.layouts.app')

@section('content')
<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
@if (is_null($result)==0)
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"> {{ $result->name}} - {{ $result->name_en}}

			<div class="text-muted pt-2 font-size-sm">
@if ($result->img != '')
    <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
@endif

			</div></h3>
        </div>

		<div class="card-toolbar">
            <a href="{{ route('static_pages.edit',$result->id) }}" class="btn btn-primary">
                <span class="svg-icon svg-icon-md">{{ __('ms_lang.btn_edit') }} <i class="icon-xl fas fa-pencil-ruler"></i></span>
            </a>
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('admin::includes.messages')
            </div>

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
            <div class="box-body">
            <table  class="table table-bordered table-striped" style="text-align:center;font-size: 16px;" >

                <tr class="{{$dis_det}}" style="font-size: 18px;color:purple">
                    <th >{{ __('ms_lang.details_t') }} </th>
                </tr>
                <tr class="{{$dis_det}}" rowspan="10">
                    <td > {!! $result->details !!} <br/><br/> </td>
                </tr>
                <tr class="{{$dis_det}}" style="font-size: 18px;color:purple">
                    <td >{{ __('ms_lang.details_en_t') }}</td>
                </tr>
                <tr class="{{$dis_det}}" rowspan="10">
                    <td> {!! $result->details_en !!} </td>
                </tr>
            </table>

        </div>
    </div>
@else
    <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>

@endif
</div>


@endsection
