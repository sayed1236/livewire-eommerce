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
<?php
$dis_cat='d-none';
$dis_det='';
$dis_img='';
$img_type='';
if($parent_id > 0)
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
                <th>{{ __('ms_lang.mobile') }}</th>
                <th>{{ __('ms_lang.username') }}</th>
                <th>{{ __('ms_lang.message') }}</th>
                <th>{{ __('ms_lang.create_at') }}</th>
                <th>{{ __('ms_lang.details_t') }}</th>
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
                    <td>{{$result->mobile}}</td>
                    <td class="text-primery" dir="rtl">{{ @$result->user->name}}</td>
                    <td class="text-primery" dir="rtl">{{ @$result->sms}}</td>
                    <td>{{ @$result->created_at}}</td>
                    <td>{{ @$result->status}}</td>
                    <td style="padding: 0px;width: 28%;">
                        <!---------- active & Dis active Button --->
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

        </div>
</div>

