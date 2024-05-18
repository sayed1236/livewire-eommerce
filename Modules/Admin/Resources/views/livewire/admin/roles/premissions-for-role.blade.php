<script lang="t">
    $(function(){
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
    function checkSubItems(id){
        alert(id);
        $(function(){
            $(".check-"+id).not(this).prop('checked', this.checked);
    });
    }
</script>
{!! Form::open(['url' => '', 'enctype' => 'multipart/form-data','wire:submit.prevent'=>'store_update']) !!}
    <div class="card-body col-md-8 offset-2">

        <div class="form-group row">
            <div class="form-group col-md-12">
                {!! Form::label('name',__('roles_permissions.role'), ['class'=>"col-12",]) !!}
                {!! Form::text('name', '', ['wire:model.lazy'=>'name','class'=>"form-control col-6 float-left",'disabled']) !!}
                {!! Form::text('name_ar', '', ['wire:model.lazy'=>'name_ar','class'=>"form-control col-6",'disabled']) !!}
            </div>
 {{-- @if($edit_object->hasPermissionTo($premissions_result->name)) checked="" @endif --}}
            <div class="form-group col-md-12">
                <label>
                    <strong>{{ __('roles_permissions.permissions') }} </strong>
                    <small class="text-danger">( <input type="checkbox" id="checkAll" class="form-input" value="all" /> تحديد الكل )</small>
                </label>
                <div class="kt-checkbox-list form-group col-md-12">

@if (is_null($premissions_results)==0)
    @foreach ($premissions_results as $premissions_result)
                    <div class="checkbox-inline col-6 p-5">
                        <label class="checkbox checkbox-danger">
                           <input type="checkbox" name="premissions" wire:model.lazy='premissions.{{ $premissions_result->id }}' class="check-{{ $premissions_result->id }}" onclick="checkSubItems({{ $premissions_result->id }})"  value="{{$premissions_result->name}}"/>
                            <span></span><strong class="text-dark">{{Auth::user()->user_lang=='ar'? $premissions_result->name_ar : $premissions_result->name }}</strong>
                        </label>
                    </div>
        @if (count($premissions_result->get_sub))
            @foreach ($premissions_result->get_sub as $get_sub)
                    <div class="checkbox-inline col-md-6  float-left">
                        <label class="checkbox checkbox-danger">
                             &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ==>
                            <input type="checkbox" name="premissions" wire:model.lazy='premissions.{{ $get_sub->id }}'  class="check-{{ $premissions_result->id }}"  value="{{$get_sub->name}}"/>
                            <span></span>{{Auth::user()->user_lang=='ar'? $get_sub->name_ar : $get_sub->name }}
                        </label>
                    </div>
            @endforeach
        @endif
    @endforeach
@endif

                </div>
            </div>
            <div class="form-group col-2 d-none">
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


