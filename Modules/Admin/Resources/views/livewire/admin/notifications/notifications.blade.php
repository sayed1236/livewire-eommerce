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
        <livewire:admin.notifications.edit />
@elseif ($showDeleted == true)
        <livewire:admin.notifications.deleted />
@else

<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if($with_id > 0)
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
                <th class="{{ $dis_img}}">{{ __('ms_lang.img_t') }}</th>
                <th>{{ __('ms_lang.title_t') }}</th>
                <th>{{ __('ms_lang.title_en_t') }}</th>
                <th>{{ __('ms_lang.details_t') }}</th>
                <th>{{ __('ms_lang.create_at') }}</th>
                <th>{{ __('ms_lang.action_t') }}</th>
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
                        @if ($img_type=='icon')
                            {!! $result->img !!}
                        @else
                        <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
                        @endif

                    </td>
                    <td class="text-primery" dir="rtl"><?php echo $result->title;  ?></td>
                    <td><?php echo $result->title_en;  ?></td>
                    <td><b dir="rtl">{{ $result->details }}</b><br/><span dir="ltr">{{ $result->details_en }}</span></td>
                    <td>{{ $result->created_at }}</td>
                    <td style="padding: 0px;width: 11%;">
                        <!---------- active & Dis active Button --->
                         <a href="javascript:void(0);" wire:click="resend('{{ $result->id }}')"><button class="btn btn-default bg-info text-white">{{ __('ms_lang.btn_resend') }} <i class="fa fa-small fa-reply"></i> </button></a>
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
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

