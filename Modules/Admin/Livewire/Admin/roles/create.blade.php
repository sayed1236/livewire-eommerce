{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">
            <div class="form-group col-md-12">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model'=>'name','class'=>"form-control"]) !!}
                {!! Form::hidden('type', 0, ['wire:model'=>'type']) !!}
                {!! Form::hidden('parent_id', 0, ['wire:model'=>'parent_id']) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model'=>'name_en','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-2 d-none">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model'=>'ord','class'=>"form-control"]) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_add_new'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

