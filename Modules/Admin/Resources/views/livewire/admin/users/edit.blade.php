
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
            <div class="form-group col-md-6">
                {!! Form::label('password', __('ms_lang.pass_t'), []) !!}
                {!! Form::password('password', ['wire:model.lazy'=>'password','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('re_password', __('ms_lang.repass_t'), []) !!}
                {!! Form::password('password_confirmation',['wire:model.lazy'=>'password_confirmation','class'=>"form-control"]) !!}
            </div>
<?php $select_arr = []; ?>
@if (count($roles))
    @foreach ($roles as $role)
        <?php $select_arr[$role->id] = Auth::user()->user_lang=='ar' ? $role->name : $role->name_en; ?>
    @endforeach
@endif
            <div class="form-group col-md-6 d-none">
                {!! Form::label('shift', __('ms_lang.user_type'), []) !!}
                {!! Form::select('role_id',$select_arr, '', ['wire:model'=>'role_id','placeholder'=>__('ms_lang.select'),'class'=>"form-control"]) !!}
            </div>
<?php $role_arr = []; ?>
@if (count($roles_found))
    @foreach ($roles_found as $role_found)
        <?php $role_arr[$role_found->key] =  $role_found->name; ?>
    @endforeach
@endif
            <div class="form-group col-md-6 d-none">
                {!! Form::label('member_plan', __('ms_lang.user_type'), []) !!}
                {!! Form::select('member_plan',$role_arr, '', ['wire:model'=>'member_plan','placeholder'=>__('ms_lang.select'),'class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.whatsapp'), []) !!}
                {!! Form::text('whatsapp', '', ['wire:model.lazy'=>'whatsapp','class'=>"form-control"]) !!}
            </div>

        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

