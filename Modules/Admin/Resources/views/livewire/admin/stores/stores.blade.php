<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
    @include('includes.status_online')
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">

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
@include('includes.messages')
            </div>
@if ($showForm == true)
        <livewire:admin.stores.edit />
@elseif ($showDeleted == true)
        <livewire:admin.stores.deleted />
@else

<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if($category_id > 0)
{
    $dis_cat='';
}
if($type == 1)
{
    $dis_det='d-none';
    $img_type='icon';
}
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('ms_lang.name_t') }}</th>
                <th>{{ trans('ms_lang.name_en_t') }}</th>
                <th >{{ trans('ms_lang.category_t') }}</th>
                <th>{{ trans('ms_lang.img_t') }}</th>
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
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->name_en }}</td>
                    <td >{{ Auth::user()->user_lang=='ar' ? @$result->category->name : @$result->category->name_en }}</td>
                    <td>
                        <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
                    </td>
                    <td style="padding: 0px;width: 20%;">
                        <!---------- active & Dis active Button --->
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
@section('footer')
<script>
    window.livewire.on('remove_modal', () => {
       $('#exampleModal').modal('hide');
    });
</script>
@endsection
</div>
