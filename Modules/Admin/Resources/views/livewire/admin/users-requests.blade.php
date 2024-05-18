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
    </div>
    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('includes.messages')
            </div>
<?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('ms_lang.name_t') }}</th>
                <th>{{ __('ms_lang.email_t') }}</th>
                <th>{{ __('ms_lang.details_t') }}</th>
                <th>{{ __('ms_lang.select_user_to').' '.__('ms_lang.btn_upgrade') }}</th>
                <th>{{ __('ms_lang.action_t') }}</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):

?>
                <tr>
                    <td>{{ $i }}</td>
                    <td class="text-primery" >{{ $result->user->name }}</td>
                    <td>{{ $result->user->email }}</td>
                    <td>{{ $result->details }}</td>
                    <td style="width: 13%;">
                        @if ($result->is_approved == 'N')
                        <a href="javascript::void(0);" wire:click='upgrade_member({{ $result->id }})'><button class="btn btn-default bg-warning text-white">{{ __('ms_lang.btn_upgrade') }}</button></a>
                        @endif

                    </td>
                    <td style="width: 3%;">
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

