{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@if( !empty($edit_object['img']))
            <div class="form-group">
                <label for="ord">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        </div>
        <div class="form-group row">
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control"]) !!}
                {!! Form::hidden('type', 0, ['wire:model.lazy'=>'type']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model.lazy'=>'name_en','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('amount', __('ms_lang.price'), []) !!}
                {!! Form::text('amount', 0, ['wire:model.lazy'=>'amount','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-6 ">
                {!! Form::label('amount_taken', __('ms_lang.amount_taken'), []) !!}
                {!! Form::text('amount_taken', 0, ['wire:model.lazy'=>'amount_taken','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('coupon_code', __('ms_lang.coupon_code'), []) !!}
                {!! Form::text('coupon_code', 0, ['wire:model.lazy'=>'coupon_code','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-6 ">
                {!! Form::label('max_num_uses', __('ms_lang.max_num_uses'), []) !!}
                {!! Form::number('max_num_uses', 0, ['wire:model.lazy'=>'max_num_uses','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('date_expire', __('ms_lang.date_expire'), []) !!}
                {!! Form::date('date_expire', 0, ['wire:model.lazy'=>'date_expire','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                    {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
                    {!! Form::hidden('img_type', '', ['wire:model.defer'=>'img_type']) !!}
            </div>

        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

