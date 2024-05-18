@extends('admin.layouts.app')

@section('content')
<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
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
<?php
    $dis_img='hidden';
?>
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>mobile</th>
                    <th>email</th>
                    <th>subject</th>
                    <th class="{{$dis_img}}">file</th>
                    <th>message</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($results as $result)


                    <tr>
                        <!--td><?php //echo $record->id;  ?> </td-->
                        <td><?php // echo $record->ord;  ?></td>

                        <td><a>{{ $result->name}}</a></td>
                        <td>{{ $result->mobile}}</td>
                        <td>{{ $result->email}}</td>
                        <td>{{ $result->subject}}</td>
                        <td class="{{$dis_img}}"><img src="{{ img_chk_exist($result->file) }}" style="width: 70px; height: 60px" /></td>
                        <td>{{ cut_arabic_text($result->message , 350) }}</td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 11%">
<?php if($result->admin_view ==1){ $styl='warning';$act_w=__('ms_lang.view'); }else{$styl='success'; $act_w=__('ms_lang.new');} ?>

                        <a href="{{route('contact-messages.show',$result->id)}}"
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('contact-messages.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('contact-messages.index')}}" onclick="
                                                            if(confirm('{{ __('ms_lang.r_u_sure') }}')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }

                        " class="btn btn-danger"><i class="icon-md  fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
    @endforeach
                </tfoot>
            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>

@endif

        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
