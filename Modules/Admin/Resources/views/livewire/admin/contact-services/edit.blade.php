{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">

        <div class="form-group row">
            <div class="form-group col-md-12">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control", 'dir'=>'ltr']) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model.lazy'=>'name_en','class'=>"form-control", 'dir'=>'ltr']) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('placeholder', __('ms_lang.placeholder'), []) !!}
                {!! Form::text('placeholder', '', ['wire:model.lazy'=>'placeholder','class'=>"form-control", 'dir'=>'ltr']) !!}
            </div>
            {{-- <div class="form-group col-md-8">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
            </div> --}}
            {{-- <div class="form-group col-md-12">
                {!! Form::label('img_type', __('ms_lang.img_type_t'), []) !!}
                {!! Form::text('img_type', '', ['wire:model.lazy'=>'img_type','class'=>"form-control", 'dir'=>'ltr']) !!}
            </div>
            <div class="form-group col-2">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div> --}}

        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

