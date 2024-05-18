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
			  <span class="svg-icon svg-icon-md"> {!! $btn_kwrd !!}
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
        <livewire:admin.roles.edit />
@elseif ($showDeleted == true)
        <livewire:admin.roles.deleted />
@elseif ($showFormPremissions == true)
        <livewire:admin.roles.premissions-for-role />
@else

<?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('ms_lang.name_t') }}</th>
                <th>{{ __('ms_lang.name_en_t') }}</th>
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
                    <td class="text-primery" dir="rtl"><?php echo $result->name_ar;  ?></td>
                    <td><?php echo $result->name;  ?></td>
                    <td style="padding: 0px;width: 35%;">
@if($result->name == 'Hi-Admin MemberShip')

@else
                        <button wire:click="add_permissions_2role('{{ $result->id }}')" class="btn btn-info" >{{ __('ms_lang.btn_add').__('roles_permissions.permissions') }}</button>
                        <!---------- active & Dis active Button --->
                        {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
                        {!! add_btn_edit('javascript:void(0);',' wire:click="edit_form('.$result->id.')"') !!}
                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"') !!}
@endif
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

