<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if(isset($with_id) && $with_id !=0)
{
    $dis_cat='';
}
if($type == 1)
{
    $dis_det='d-none';
    $img_type='icon';
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
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control"]) !!}
                {!! Form::hidden('type', 0, ['wire:model.lazy'=>'type']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model.lazy'=>'name_en','class'=>"form-control"]) !!}
            </div>

<?php $select_arr = [0=>__('ms_lang.select')]; ?>
@if (count($categories))
    @foreach ($categories as $category)
        <?php $select_arr[$category->id] = Auth::user()->user_lang=='ar' ? $category->name : $category->name_en; ?>
    @endforeach
@endif
            <div class="form-group col-md-12  {{ $dis_cat }}">
                {!! Form::label('category', __('ms_lang.category_t'), []) !!}
                {!! Form::select('with_id',@$select_arr, '', ['wire:model.lazy'=>'with_id','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-2">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-md-10 {{ $dis_img }}">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                    {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
                    {!! Form::hidden('img_type', '', ['wire:model.defer'=>'img_type']) !!}
            </div>
            <div class="form-group col-md-12 {{ $dis_det }}">
                {!! Form::label('url', __('ms_lang.details_t'), []) !!}
                {!! Form::textarea('url_l', '', ['wire:model.lazy'=>'url_l','class'=>"form-control editor1",'rows'=>"1"]) !!}
            </div>
            <div class="form-group col-md-12 {{ $dis_det }}">
                {!! Form::label('google_adv', __('ms_lang.details_en_t'), []) !!}
                {!! Form::textarea('google_adv', '', ['wire:model.lazy'=>'google_adv','class'=>"form-control editor1",'rows'=>"3"]) !!}
            </div>

        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

