{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@if($edit_object['img'] !='')
            <div class="form-group">
                <label for="img">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endif
        </div>
        <div class="form-group row">
            <?php $select_arr = [0=>__('ms_lang.select')]; ?>
            @if (count($sizes))
            @foreach ($sizes as $size)
                <?php $select_arr[$size->id] = $size->value; ?>
            @endforeach
            @endif
                <div class="form-group col-md-6">
                    {!! Form::label('size_id', __('ms_lang.size'), []) !!}
                    {!! Form::select('size_id',@$select_arr, '', ['wire:model.lazy'=>'size_id','class'=>"form-control"]) !!}
                </div>
                <?php $select_arr = [0=>__('ms_lang.select')]; ?>
            @if (count($colors))
            @foreach ($colors as $color)
                <?php $select_arr[$color->id] = $color->name; ?>
            @endforeach
            @endif
                <div class="form-group col-md-6">
                    {!! Form::label('color_id', __('ms_lang.color'), []) !!}
                    {!! Form::select('color_id',@$select_arr, '', ['wire:model.lazy'=>'color_id','class'=>"form-control"]) !!}
                </div>
            <div class="form-group col-md-6">
                {!! Form::label('price', __('ms_lang.price'), []) !!}
                {!! Form::number('price', '', ['wire:model.lazy'=>'price','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('amount', __('ms_lang.amount'), []) !!}
                {!! Form::number('amount', '', ['wire:model.lazy'=>'amount','class'=>"form-control"]) !!}
            </div>

            <div class="form-group col-md-6 ">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

