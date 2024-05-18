

{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'update']) !!}
<div class="col-md-6 offset-3" >
    @include('includes.messages')
</div>
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@isset($edit_object['img'])
            <div class="form-group">
                <label for="ord">{{ __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endisset
        </div>
        <div class="form-group row">
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control"]) !!}
                {!! Form::hidden('type', 0, ['wire:model.lazy'=>'type']) !!}
                {!! Form::hidden('parent_id', 0, ['wire:model.lazy'=>'parent_id']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('email', __('ms_lang.email'), []) !!}
                {!! Form::email('email', '', ['wire:model.lazy'=>'email','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('mobile', __('ms_lang.mobile'), []) !!}
                <input type="tel" name="mobile" wire:model.lazy="mobile" class="form-control" />
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::file('profile_photo_path', ['wire:model'=>'profile_photo_path','class'=>"form-control"]) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

