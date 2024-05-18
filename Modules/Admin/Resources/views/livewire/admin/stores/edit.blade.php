<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if(isset($category_id) && $category_id !=0)
{
    $dis_cat='';
}
if($type == 1)
{
    $dis_det='d-none';
    $img_type='icon';
}
?>
<div>
{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">
            @include('includes.messages')
        </div>
        <div class="form-group row">

@if($edit_object['img'] !='')
            <div class="form-group d-block">
                <label for="ord">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endif
@isset($get_multi_img)
@foreach ($get_multi_img as $imgg)
    <div class="form-group">
        <button type="button" class="close" data-toggle="modal" data-target="#exampleModal"   wire:click='get_ask({{ $imgg->id }})'>
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
            {{-- <label for="ord">{{  __('ms_lang.img_t') }}</label> --}}
            <img src="{{ img_chk_exist($imgg->img) }}" style="width: 70px; height: 60px" />
    </div>
@endforeach
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
            <div class="form-group col-md-12">
                {!! Form::label('category', __('ms_lang.category_t'), []) !!}
                {!! Form::select('category_id',@$select_arr, '', ['wire:model.lazy'=>'category_id','class'=>"form-control",'wire:change'=>'get_sub_gategory']) !!}
            </div>
@if (isset($sub_categories))
            <?php $select_arrr = [0=>__('ms_lang.select')]; ?>
            @if (count($sub_categories))
                @foreach ($sub_categories as $sub_categorie)
                    <?php $select_arrr[$sub_categorie->id] = Auth::user()->user_lang=='ar' ? $sub_categorie->name : $sub_categorie->name_en; ?>
                @endforeach
            @endif
            <div class="form-group col-md-12">
                {!! Form::label('sub_category', __('ms_lang.sub_category_t'), []) !!}
                {!! Form::select('sub_category_id',@$select_arrr, '', ['wire:model.lazy'=>'sub_category_id','class'=>"form-control"]) !!}
            </div>
@endif
<?php $select_arrrr = [0=>__('ms_lang.select')]; ?>

@if (count($cities))
    @foreach ($cities as $city)
        <?php $select_arrrr[$city->id] = Auth::user()->user_lang=='ar' ? $city->name : $city->name_en; ?>
    @endforeach
@endif
            <div class="form-group col-md-12">
                {!! Form::label('city', __('ms_lang.city'), []) !!}
                {!! Form::select('city_id',@$select_arrrr, '', ['wire:model.lazy'=>'city_id','class'=>"form-control"]) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('latitude', __('ms_lang.latitude_t'), []) !!}
                {!! Form::text('latitude', '', ['wire:model.lazy'=>'latitude','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('longitude', __('ms_lang.longitude_t'), []) !!}
                {!! Form::text('longitude', '', ['wire:model.lazy'=>'longitude','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('work_time_from', __('ms_lang.work_time_from'), []) !!}
                {!! Form::time('work_time_from', '', ['wire:model.lazy'=>'work_time_from','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('work_time_to', __('ms_lang.work_time_to'), []) !!}
                {!! Form::time('work_time_to', '', ['wire:model.lazy'=>'work_time_to','class'=>"form-control"]) !!}
            </div>

            <div class="form-group col-md-6 ">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}   
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('img', __('ms_lang.imgs_t'), []) !!}
                {!! Form::file('img', ['wire:model.lazy'=>'multi_img','class'=>"form-control",'multiple']) !!}   
            </div>
            @if (count($contactes))
                @foreach ($contactes as $contact)
                <div class="form-group col-md-6">
                    {!! Form::label('longitude',$contact->name, []) !!}
                    {!! Form::text('longitude', '', ['wire:model.lazy'=>'contact.'.$contact->id,'class'=>"form-control"]) !!}
                </div>
                @endforeach                
            @endif

            <div class="form-group col-md-12 {{ $dis_det }}">
                {!! Form::label('details', __('ms_lang.details_t'), []) !!}
                {!! Form::textarea('details', '', ['wire:model.lazy'=>'note','class'=>"form-control editor1",'rows'=>"3"]) !!}
            </div>
            <div class="form-group col-md-12 {{ $dis_det }}">
                <label for="details_en"> </label>
                {!! Form::label('details_en', __('ms_lang.details_en_t'), []) !!}
                {!! Form::textarea('details_en', '', ['wire:model.lazy'=>'note_en','class'=>"form-control editor1",'rows'=>"3"]) !!}
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}

<div wire:ignore.self  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              
            </div>
            <div class="modal-body">
                هل تريد حذف هذه الصوره
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('ms_lang.btn_close') }}</button>
                <button type="button" class="btn btn-danger font-weight-bold" wire:click='delete'>{{ __('ms_lang.btn_delete') }}</button>
            </div>
        </div>
    </div> 
</div>

</div>