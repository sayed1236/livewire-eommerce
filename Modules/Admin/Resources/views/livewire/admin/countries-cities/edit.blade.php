<?php
$dis_img='';
$dis_flag='d-none';
$dis_det='';
$dis_delivery_price='';
$dis_other='d-none';


if($parent_id > 0)
{
    $dis_img='d-none';
    $dis_flag='d-none';
    $dis_det='d-none';
    $dis_delivery_price='d-none';
}
?>
{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@isset($edit_object['img'])
            <div class="form-group">
                <label for="ord">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endisset
        </div>
        <div class="form-group row">
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control", 'dir'=>'rtl']) !!}
                {!! Form::hidden('type', 0, ['wire:model.lazy'=>'type']) !!}
                {!! Form::hidden('parent_id', 0, ['wire:model.lazy'=>'parent_id']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model.lazy'=>'name_en','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-2">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-4 {{ $dis_delivery_price }}">
                {!! Form::label('delivery_price', __('ms_lang.delivery_price'), []) !!}
                {!! Form::number('delivery_price', 0, ['wire:model.lazy'=>'delivery_price','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-md-6 {{ $dis_img }}">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                    {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-10 {{ $dis_flag }}">
                {!! Form::label('flag', __('ms_lang.flag'), []) !!}
                    {!! Form::file('flag', ['wire:model.lazy'=>'flag','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-3 {{ $dis_other }}">
                {!! Form::label('name_en', __('ms_lang.currency_code'), []) !!}
                {!! Form::text('currency_code', '', ['wire:model.lazy'=>'currency_code','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-3 {{ $dis_other }}">
                {!! Form::label('name_en', __('ms_lang.currency_code_en'), []) !!}
                {!! Form::text('currency_code_en', '', ['wire:model.lazy'=>'currency_code_en','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-3 {{ $dis_other }}">
                {!! Form::label('name_en', __('ms_lang.country_code'), []) !!}
                {!! Form::text('country_code', '', ['wire:model.lazy'=>'country_code','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-3 {{ $dis_other }}">
                {!! Form::label('name_en', __('ms_lang.dail_code'), []) !!}
                {!! Form::text('dail_code', '', ['wire:model.lazy'=>'dail_code','class'=>"form-control"]) !!}
            </div>

        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

