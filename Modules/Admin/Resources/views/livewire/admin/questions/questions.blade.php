<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
    @include('includes.status_online')
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">

			</div></h3>
        </div>

		<div class="card-toolbar col-12 bg-warning">
            <form action="" class="form-group col-12 row">
                <div class="form-group col-5">
                    <label for="">{{ trans('ms_lang.username') }}</label>
                    <select name="user_id" wire:model='user_id' class="form-control">
                        <option value="0">{{ __('ms_lang.all') }}</option>
@if (count($members_questions))
    @foreach ($members_questions as $members_question)
                        <option value="{{ $members_question->id }}">الاسم: {!! $members_question->name.' -<i class="fa fa-phone"></i>الهاتف: '. $members_question->mobile !!} </option>
    @endforeach
@else

@endif
                    </select>
                </div>
                {{-- <div class="form-group col-3">
                    <label for="">{{ trans('ms_lang.car') }}</label>
                    <select name="car_id" wire:model='car_id' class="form-control">
                        <option value="0">{{ __('ms_lang.all') }}</option>
@if (count($members_cars))
    @foreach ($members_cars as $members_car)
                        <optgroup label="{{  $members_car->name }}">
        @if (count($members_car->sub_category))
            @foreach ($members_car->sub_category as $car_model)
                            <option value="{{ $car_model->id }}">{{ $car_model->name }}</option>
            @endforeach
        @endif
                        </optgroup>
    @endforeach
@else

@endif
                    </select>
                </div> --}}
                <div class="form-group col-3">
                    <label for="">{{ trans('ms_lang.city') }}</label>
                    <select name="city_id" wire:model='city_id' class="form-control">
                        <option value="0">{{ __('ms_lang.all') }}</option>
@if (count($search_cities))
    @foreach ($search_cities as $search_city)
                        <optgroup label="{{  $search_city->name }}">
        @if (count($search_city->cities))
            @foreach ($search_city->cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        @endif
                        </optgroup>
    @endforeach
@else

@endif
                    </select>
                </div>
                <div class="form-group col-2">
                    <label for="">{{ trans('ms_lang.status') }}</label>
                    <select name="status" wire:model='status' class="form-control">
                        <option value="0">{{ __('ms_lang.all') }}</option>
                        <option value="open">{{ __('ms_lang.open') }}</option>
                        <option value="close">{{ __('ms_lang.closed') }}</option>

                    </select>
                </div>
                <div class="form-group col-2">
                    <label for="">{{ trans('ms_lang.manufacturing_year') }}</label>
                    <input type="number" min="1960" max="{{ date('Y')+1 }}" wire:model='manufacturing_year' name="manufacturing_year" class="form-control">
                </div>
                <div class="box-footer">
                    {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
                    <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
                </div>
            </form>
            <!--begin::Button-->
			{{-- <a href="javascript:void(0);" wire:click="edit_form" class="btn btn-primary font-weight-bolder">
			<span class="svg-icon svg-icon-md"> {!!$btn_kwrd !!}
            </a> --}}
			<!--end::Button-->
        </div>


    </div>

    <div class="card-body" style="overflow-x: scroll;">
            <div class="col-md-6 offset-3" >
@include('includes.messages')
            </div>
@if  ($showDeleted == true)
        <livewire:admin.questions.deleted />
@else

<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if(count($results)):
?>
        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
                <tr style="border:2px double #0000">
                    <th colspan="3"> <strong style="color:#5B6F80">{{ __('ms_lang.closed') }}</strong>  <i class="fa fa-fill-drip icon-xl" style="color:#5B6F80"></i> </th>
                    <th colspan="3"> <strong style="color:#C08BB9B2">{{ __('ms_lang.partial_closed') }}</strong>  <i class="fa fa-fill-drip icon-xl" style="color:#C08BB9B2"></i> </th>
                    <th colspan="4" style="background-color:#1D0404"> <strong style="color:#FFFFFF">{{ __('ms_lang.new') }}</strong> <i class="fa fa-fill-drip icon-xl" style="color:#FFFFFF"></i> </th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>{{ trans('ms_lang.details_t') }}</th>
                    <th>{{ trans('ms_lang.username') }}</th>
                    <th>{{ trans('ms_lang.img_t') }}</th>
                    <th>{{ trans('ms_lang.car') }}</th>
                    <th>{{ trans('ms_lang.manufacturing_year') }}</th>
                    <th>{{ trans('ms_lang.audio_file') }}</th>
                    <th>{{ trans('ms_lang.city') }}</th>
                    <th>{{ __('ms_lang.date_add') }}</th>
                    <th>{{ trans('ms_lang.action_t') }}</th>
                </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):
        $photos=json_decode($result->photos);
?>
                <tr @if ($result->status == 'close') style="background-color:#5B6F80" @elseif ($result->fani_close_status == 'close') style="background-color:#C08BB9B2" @endif>
                    <td><?php echo $i; ?></td>
                    <td>{{ $result->description }}</td>
                    <td>{{ Auth::user()->user_lang=='ar' ? @$result->user->name : @$result->user->name_en }}</td>
                    <td>
                        @if (is_null($photos) == 0)
                            @foreach ($photos as $photo)
                                @if(!empty($photo))
                                    <img src="{{ img_chk_exist($photo) }}" style="width: 70px; height: 60px;padding-left:3px" />
                                @endif
                            @endforeach
                        @endif

                    </td>
                    <td>{{ Auth::user()->user_lang=='ar' ? @$result->user_car->car->name : @$result->user_car->car->name_en }}</td>
                    <td>{!! $result->manufacturing_year !!}</td>
                    <td>@if(!empty($result->audio_file))<a href="{!! img_chk_exist('medias/'.$result->audio_file) !!}" target="_blank">{{ __('ms_lang.view') }}</a> @endif</td>
                    <td><?php  if($result->city_id ==0){ echo Auth::user()->user_lang=='ar' ?'جميع المناطق':'All regoins';  }else{ echo Auth::user()->user_lang=='ar' ? @$result->city->name : @$result->city->name_en; } ?></td>
                    <td>{{ $result->created_at }}</td>
                    <td style="padding: 0px;width: 17%;">
                        <button wire:click="view_requests4question('{{ $result->id }}')" class="btn btn-info pl-1 pr-1">{{ __('ms_lang.requests').' '.__('ms_lang.users') }}</button>
                        <a href="javascript:void(0);"  wire:click="rates('{{ $result->id }}')" ><button class="btn  bg-blue-400">{{ __('ms_lang.rates') }}</button> </a>
                        <!---------- active & Dis active Button --->
                        <button wire:click="close_question('{{ $result->id }}')" class="btn bg-blue-400 pl-1 pr-0 text-white">{{ __('ms_lang.btn_close').' '.__('ms_lang.question') }} <i class="icon-md far fa-window-close text-white"></i></button>
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"') !!}
                    </td>
                </tr>
<?php $i++; endforeach; ?>
            </tbody>
        </table>
        <div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
            <ul class="pagination">
                {{ $results->links() }}
            </ul>
        </div>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">{{ __('ms_lang.no_results') }}</center></h2>
<?php endif; ?>
        <!--end: Datatable-->

        @endif
        </div>
    @include('livewire.admin.questions.view_one_model')
    @include('livewire.admin.questions.view_rate_model')
</div>

