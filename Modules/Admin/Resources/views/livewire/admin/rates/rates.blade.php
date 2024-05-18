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
        <livewire:admin.countries-cities.edit />
@elseif ($showDeleted == true)
        <livewire:admin.countries-cities.deleted />
@else

<?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
                <tr class="text-center bg-red-400">
                    <th>{{ __('ms_lang.ord_t') }}</th>
                    <th>{{ __('ms_lang.name_t') }}</th>
                    <th>{{ __('ms_lang.username') }}</th>
                    <th>{{ __('ms_lang.rate') }}</th>
                    <th>{{ __('ms_lang.rated_in') }}</th>
                    <th>{{ __('ms_lang.rated_app') }}</th>
                    <th>{{ __('ms_lang.notes') }}</th>
                    <th>{{ __('ms_lang.date_add') }}</th>
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
                    <td class="text-primery" dir="rtl">{{ $result->user->name }}</td>
                    <td>{{ $result->user_rated->name }}</td>
                    <td>{{ $result->rate }}<i class="fa fa-star" style="color: gold"></i></td>
                    <td>{{ @$result->rated_in->description }}</td>
                    <td>{{ $result->rate_app }}<i class="fa fa-star" style="color: gold"></i></td>
                    <td>{{ $result->notes }}</td>
                    <td>{{ $result->created_at }}</td>
                    <td style="padding: 0px;width:10%;">
                        <!---------- active & Dis active Button --->
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_approved) !!}
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

