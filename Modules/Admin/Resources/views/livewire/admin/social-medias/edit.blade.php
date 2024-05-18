{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@isset($edit_object['img'])
            <div class="form-group col-6">
                <label for="ord">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endisset
        </div>
        <div class="form-group row">
            <div class="form-group col-md-3">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control", 'dir'=>'ltr']) !!}
            </div>
            <div class="form-group col-2">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-2">
                {!! Form::label('ord_footer', __('ms_lang.ord_footer_t'), []) !!}
                {!! Form::number('ord_footer', 0, ['wire:model.lazy'=>'ord_footer','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-md-5">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                @if ($img_type == 'icon')
                    {!! Form::text('img_icon', '', ['wire:model.lazy'=>'img_icon','class'=>"form-control"]) !!}
                    {!! Form::hidden('img_type', '', ['wire:model.defer'=>'img_type']) !!}
                @else
                    {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
                    {!! Form::hidden('img_type', '', ['wire:model.defer'=>'img_type']) !!}
                @endif
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('url_link', __('ms_lang.url_link_t'), []) !!}
                {!! Form::textarea('url_link', '', ['wire:model.lazy'=>'url_link','class'=>"form-control",'dir'=>'ltr','rows'=>"1"]) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

