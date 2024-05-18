@extends('admin::admin.layouts.app')

@section('content')

<div class="card card-custom">
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?><div class="text-muted pt-2 font-size-sm"></div></h3>
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
                <form @if (isset($result->id))
                        action="{{route('static_pages.update', $result->id ) }}"
                    @else
                        action="{{route('static_pages.store') }}"
                    @endif

                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else

                    @endif
                    <div class="card-body col-md-10 offset-1">
                        <div class="form-group row">
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group {{$dis_img}}">
                        <label for="ord">{{ __('ms_lang.img_t') }}</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
                        </div>
                    <div class="form-group row">
                        <input type="hidden" name="type" value="{{ @$result->type}}" />
                        <input type="hidden" name="parent_id" value="{{ @$result->parent_id}}" />
                    <div class="form-group col-md-6">
                        <label for="Name">{{ __('ms_lang.name_t') }}</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">{{ __('ms_lang.name_en_t') }}</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6 d-none">
                        <label for="ord">{{ __('ms_lang.ord_t') }}</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-6 {{$dis_img}}">
                        <label for="img">{{ __('ms_lang.img_t') }}</label>
                        <input type="file" name="img"  class="form-control" id="img" />
                    </div>

                    <div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details">{{ __('ms_lang.details_t') }}</label>
                        <textarea name="details" class="form-control editor1"  rows="3"  placeholder="اضف ...">{{ @$result->details }}</textarea>
                    </div>
                    <div class="form-group col-md-12 {{$dis_det}}">
                        <label for="details_en">{{ __('ms_lang.details_en_t') }} </label>
                        <textarea name="details_en" class="form-control editor1" rows="3"  placeholder="Enter ...">{{ @$result->details_en }}</textarea>
                    </div>
                        </div>
                    <div class="box-footer col-md-12 ">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="{{ __('ms_lang.btn_edit') }}" />
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">{{ __('ms_lang.btn_back') }}</button>
                    </div>
                </div>
                    </form>
                </div>
          </div>

@endsection
