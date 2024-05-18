<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
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
            {{-- <a href="javascript:void(0);" wire:click="deleted" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md"> deleted
              </a> --}}
			<!--end::Button-->
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('includes.messages')
            </div>
@if ($showForm == true)
        <livewire:admin.votes.edit />
@elseif ($showDeleted == true)
        <livewire:admin.votes.deleted />
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
    $dis_det='';
}
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th class="{{ $dis_img}}">IMG/الصورة</th>
                <th>الاسم</th>
                <th>EN Name </th>
                <th>{{ __('ms_lang.view') }}</th>
                <th>Action/الاجراء</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):

?>
                <tr>
                    <td>@if($result->type == 1) <i class="fa fa-star text-warning"></i> @endif {{ $i }}</td>
                    <td>
                        @if ($img_type=='icon')
                            {!! $result->img !!}
                        @else
                        <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
                        @endif

                    </td>
                    <td class="text-primery" dir="rtl"><?php echo $result->name;  ?></td>
                    <td><?php echo $result->name_en;  ?></td>
                    <td style="padding: 0px;width: 10%;">
                         <a href="{{ url(config('app.url_admin').'votes-points/'.$result->id.'') }}"><button class="btn btn-default bg-warning text-white">{{ __('ms_lang.vote').' '.__('ms_lang.points') }}</button></a>
                         <a href="{{ url(config('app.url_admin').'users-votes/'.$result->id.'') }}"><button class="btn btn-default bg-info text-white pl-4 pr-4">{{ __('ms_lang.view').' '.__('ms_lang.vote') }}s</button></a>
                    </td>
                    <td style="padding: 0px;width: 16%;">
                        <!---------- active & Dis active Button --->
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
                        {!! add_btn_edit('javascript:void(0);',' wire:click="edit_form('.$result->id.')"') !!}
                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"') !!}
                    </td>
                </tr>
<?php $i++; endforeach; ?>
            </tbody>
          </table>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">{{ __('ms_lang.no_results') }}</center></h2>
<?php endif; ?>
        <!--end: Datatable-->

        @endif
        </div>
</div>

