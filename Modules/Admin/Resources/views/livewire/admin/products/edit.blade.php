{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">
        <div class="form-group row">

@if($edit_object['img'] !='')
            <div class="form-group col-md-12">
                <label for="img">{{  __('ms_lang.img_t') }}</label>
                <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
            </div>
@endif
@if($product_gallaries !='')
<?php $ol=1; ?>
    @foreach ($product_gallaries as $product_gallary)
    <div class="form-group col-md-3">
        <label for="img">{{  __('ms_lang.imgs_t').'('.$ol.')' }} {!! add_btn_delete('javascript:void(0);',' wire:click="delete_img_ms('.$product_gallary['id'].')"') !!} </label>
        <img src="{{ img_chk_exist($product_gallary['img']) }}" style="width: 70px; height: 60px" />
    </div>
    @endforeach
            
@endif
        </div>
        <div class="form-group row">
            <div class="form-group col-md-6">
                {!! Form::label('name', __('ms_lang.name_t'), []) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control"]) !!}
            </div>
            
            <div class="form-group col-md-6">
                {!! Form::label('name_en', __('ms_lang.name_en_t'), []) !!}
                {!! Form::text('name_en', '', ['wire:model.lazy'=>'name_en','class'=>"form-control"]) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('product_code', __('ms_lang.product_code'), []) !!}
                {!! Form::text('product_code', '', ['wire:model.lazy'=>'product_code','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('stoke_id', __('ms_lang.stoke'), []) !!}
                {!! Form::text('stoke_id', '', ['wire:model.lazy'=>'stoke_id','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6 ">
                {!! Form::label('stoke_id', __('ms_lang.category_t'), []) !!}
                @if (count($categories))
                    <select wire:model.lazy='category_id' class="form-control">
                        <option value="">{{ __('ms_lang.choose') }}</option>
                        @foreach ($categories as $category)
                            <option disabled><span style="color: blue"> {{ Auth::user()->user_lang=='ar' ? $category->name : $category->name_en; }}</span></option>
                            @foreach ($category->sub_category as $cat)
                                <option value="{{ $cat->id }}">--> {{ Auth::user()->user_lang=='ar' ? $cat->name : $cat->name_en; }}</option>
                            @endforeach
                        @endforeach
                    </select>
                @endif
            </div>

        <?php $select_arr = [0=>__('ms_lang.select')]; ?>
        @foreach (__('ms_lang.is_used') as $key=>$value)
            <?php $select_arr[$key] = $value; ?>
        @endforeach
            <div class="form-group col-md-6">
                {!! Form::label('is_used', __('ms_lang.status'), []) !!}
                {!! Form::select('is_used',@$select_arr, '', ['wire:model.lazy'=>'is_used','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('price', __('ms_lang.price'), []) !!}
                {!! Form::number('price', '', ['wire:model.lazy'=>'price','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('discount', __('ms_lang.discount'), []) !!}
                {!! Form::number('discount', '', ['wire:model.lazy'=>'discount','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('tag', __('ms_lang.tag'), []) !!}
                {!! Form::text('tag', '', ['wire:model.lazy'=>'tag','class'=>"form-control"]) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('tag_en', __('ms_lang.tag_en'), []) !!}
                {!! Form::text('tag_en', '', ['wire:model.lazy'=>'tag_en','class'=>"form-control"]) !!}
            </div>

<?php $select_arr = [0=>__('ms_lang.select')]; ?>
@if (isset($colors))
    @foreach ($colors as $color)
        <?php $select_arr[$color->id] = Auth::user()->user_lang=='ar' ? $color->name : $color->name_en; ?>
    @endforeach
@endif
            <div class="form-group col-md-12 ">
                {!! Form::label('color', __('ms_lang.color'), []) !!}
                {!! Form::select('color_id',@$select_arr, '', ['wire:model.lazy'=>'color_id','class'=>"form-control"]) !!}
            </div>
<?php $select_arr = [0=>__('ms_lang.select')]; ?>
@if (isset($brands))
    @foreach ($brands as $brand)
        <?php $select_arr[$brand->id] = Auth::user()->user_lang=='ar' ? $brand->name : $brand->name_en; ?>
    @endforeach
@endif
            <div class="form-group col-md-12 ">
                {!! Form::label('brand', __('ms_lang.brand'), []) !!}
                {!! Form::select('brand_id',@$select_arr, '', ['wire:model.lazy'=>'brand_id','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6 ">
                {!! Form::label('img', __('ms_lang.img_t'), []) !!}
                {!! Form::file('img', ['wire:model.lazy'=>'img','class'=>"form-control"]) !!}
            </div>
            <div class="form-group col-md-6 ">
                {!! Form::label('mul_img', __('ms_lang.imgs_t'), []) !!}
                {!! Form::file('mul_img', ['wire:model.lazy'=>'mul_img','class'=>"form-control",'multiple']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::label('ord', __('ms_lang.ord_t'), []) !!}
                {!! Form::number('ord', 0, ['wire:model.lazy'=>'ord','class'=>"form-control",'min'=>0]) !!}
            </div>
            <div class="form-group col-md-12 ">
                {!! Form::label('details', __('ms_lang.details_t'), []) !!}
                {!! Form::textarea('details', '', ['wire:model.lazy'=>'details','class'=>"form-control editor1",'rows'=>"3"]) !!}
            </div>
            <div class="form-group col-md-12 ">
                <label for="details_en"> </label>
                {!! Form::label('details_en', __('ms_lang.details_en_t'), []) !!}
                {!! Form::textarea('details_en', '', ['wire:model.lazy'=>'details_en','class'=>"form-control editor1",'rows'=>"3"]) !!}
            </div>
            <hr>
            <label for="">{{ __('ms_lang.sizes') }}</label>
            <div class="form-group col-md-12 ">
                <table >
                    <thead>
                        <tr>
                            <th>size</th>
                            <th>qnt</th>
                            <th>
                                <button type="submite"  class="btn btn-default btn-small" style="background-color: silver; color:blue" wire:click.prevent='add'>add more</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($Productsizes != null)
                            @foreach ($Productsizes as $index=>$prod)
                            <tr>
                                <td><p>{{ @$prod['size']['value'] }}</p></td>
                                <td><p>{{ @$prod['amount'] }}</p></td>
                                <td> 
                                    <button type="submite"  class="btn btn-default " style="background-color: red;color:white" data-toggle="modal" data-target="#exampleModal" wire:click.prevent='edit_get_countity({{  @$prod['id'] }})'>edit</button>
                                    <button type="submite"  class="btn btn-default " style="background-color: red;color:white" wire:click='remove_exist({{  @$prod['id'] }})'>delete</button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td>اضافه مقاسات جديده</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($templates as $index=>$template)
                        <tr>
                            <td>
                                <div class="form-group col-md-6">
                                    {{-- {!! Form::text('size', '', ['wire:model.lazy'=>'size_id','class'=>"form-control"]) !!} --}}
                                    <select name="" id="" class="form-control" wire:model='size_id.{{ $index }}' style="width: 200px">
                                        <option value="0"></option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-md-6">
                                    <input type="text" name=""  class="form-control" wire:model='quntity.{{  $index  }}'>
                                </div>
                            </td>
                            <td>
                                <button type="submite"  class="btn btn-default " style="background-color: red;color:white" wire:click.prevent='remove({{ $index }})'>delete</button>
                                <button type="submite"  class="btn btn-default " style="background-color: blue;color:white" wire:click.prevent='save({{ $index }})'>update</button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            {!! Form::submit(__('ms_lang.btn_save'), ['class'=>"btn btn-info pull-center"]) !!}
            <button type="reset"  class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
        </div>
    </div>
{!! Form::close() !!}
