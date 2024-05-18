{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">

        <div class="form-group row">
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name_ar', '', ['wire:model.lazy'=>'name_ar','class'=>"form-control"]) !!}
                {!! Form::hidden('type', 0, ['wire:model.lazy'=>'type']) !!}
                {!! Form::hidden('parent_id', 0, ['wire:model.lazy'=>'parent_id']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-2 d-none">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.url_link_t'), []) !!}
                {!! Form::text('page_url', '', ['wire:model'=>'page_url','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::text('img', '', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
            </div>
            <div class="checkbox-inline col-3">
                <label class="checkbox checkbox-danger">
                    <input type="checkbox" name="add_chk" wire:model.defer='add_chk' value="">
                    <span></span>{{ __('ms_lang.btn_add') }}
                </label>
            </div>
            <div class="checkbox-inline col-3">
                <label class="checkbox checkbox-danger">
                    <input type="checkbox" name="edit_chk" wire:model.defer='edit_chk'  value="">
                    <span></span>{{ __('ms_lang.btn_edit') }}
                </label>
            </div>
            <div class="checkbox-inline col-3">
                <label class="checkbox checkbox-danger">
                    <input type="checkbox" name="active_chk" wire:model.defer='active_chk'  value="">
                    <span></span>{{ __('ms_lang.active') }}
                </label>
            </div>
            <div class="checkbox-inline col-3">
                <label class="checkbox checkbox-danger">
                    <input type="checkbox" name="delete_chk" wire:model.defer='delete_chk'  value="">
                    <span></span>{{ __('ms_lang.btn_delete') }}
                </label>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}



