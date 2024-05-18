<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
    @include('admin::includes.status_online')
	<div class="flex-wrap py-5 card-header">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="pt-2 text-muted font-size-sm">

			</div></h3>
        </div>

		<div class="card-toolbar">
            <!--begin::Button-->
			<a href="javascript:void(0);" wire:click="edit_form" class="btn btn-primary font-weight-bolder">
			  <span class="svg-icon svg-icon-md"> {!!$btn_kwrd !!}
            </a>
			<!--end::Button-->
    </div>


  </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
                @include('admin::includes.messages')
            </div>
@if ($showForm == true)
        <livewire:admin::admin.products.edit />
@elseif ($showDeleted == true)
        <livewire:admin::admin.products.deleted />
@else

<?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('ms_lang.name_t') }}</th>
                <th >{{ trans('ms_lang.category_t') }}</th>
                <th >{{ trans('ms_lang.brand_t') }}</th>
                <th>{{ trans('ms_lang.img_t') }}</th>
                <th>{{ trans('ms_lang.price') }}</th>
                <th >{{ trans('ms_lang.details_t') }}</th>
                <th>{{ trans('ms_lang.action_t') }}</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):

?>
      <tr>
          <td><?php echo $i; ?></td>
          <td>
            <a href="{{ url('product-details/'.$result->id) }}" target="_blank">
              {{ Auth::user()->user_lang=='ar' ? @$result->name : @$result->name_en }}
            </a>
          </td>
          <td>
            <a href="{{ url('product-details/'.$result->id) }}" target="_blank">
              {{ Auth::user()->user_lang=='ar' ? @$result->category->name : @$result->category->name_en }}
              /
              {{ Auth::user()->user_lang=='ar' ? @$result->category->parent->name : @$result->category->parent->name_en }}
            </a>
          </td>
          <td>
            <a href="{{ url('product-details/'.$result->id) }}" target="_blank">
              {{ Auth::user()->user_lang=='ar' ? @$result->brand->name : @$result->brand->name_en }}
              {{--  /  --}}
              {{--  {{ Auth::user()->user_lang=='ar' ? @$result->brand->parent->name : @$result->brand->parent->name_en }}  --}}
            </a>
          </td>
          <td>
              <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
          </td>
          <td>{{ $result->price }}</td>
          <td  >{{ Auth::user()->user_lang=='ar' ? @$result->details : @$result->details_en }}</td>
          <td style="padding: 0px;width: 20%;">
              <!---------- active & Dis active Button --->
              <a href="{{ url(config('app.url_admin').'products-sizes/'.$result->id.'') }}"><button class="btn btn-default bg-info">{{ __('ms_lang.sizes') }}</button></a>
              {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
              {!! add_btn_edit('javascript:void(0);',' wire:click="edit_form('.$result->id.')"') !!}
              {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"') !!}
          </td>
      </tr>
<?php $i++; endforeach; ?>
            </tbody>
          </table>
          <div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
            <ul class="pagination">
                {{ $results->links() }}
            </ul>
        </div>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">{{ __('ms_lang.no_results') }}</center></h2>
<?php endif; ?>
        <!--end: Datatable-->

        @endif
        </div>
</div>

