<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
    @include('admin::includes.status_online')
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">

			</div></h3>
        </div>

		<div class="card-toolbar">
            <!--begin::Button-->
			{{-- <a href="javascript:void(0);" wire:click="edit_form" class="btn btn-primary font-weight-bolder">
			  <span class="svg-icon svg-icon-md"> {!!$btn_kwrd !!}
            </a> --}}
			<!--end::Button-->
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;" >
            <div class="col-md-6 offset-3" >
                @include('admin::includes.messages')
            </div>

<?php
// if(count($results)):
?>
          <table  class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>رقم الطلب</th>
                <th >اسم طالب المنتج</th>
                <th>السعر الكلي</th>
                <th >انشئ في</th>
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
                    <td>{{ @$result->order_num }}</td>
                    <td>{{ @$result->user->name }}</td>
                    <td>{{ @$result->order_total_price }} </td>
                    <td>{{ @$result->created_at }}</td>
                    <td style="padding: 0px;width: 20%;">
                        <!---------- active & Dis active Button --->
                        <a href="javascript:void(0);" wire:click='user_oreder({{ @$result->id }})'  data-toggle="modal" data-target="#getOrderData" class="btn btn-default bg-warning text-primary">تفاصيل الطلب</a>
                        <a href="javascript:void(0);" wire:click='confirm_order({{ @$result->id }})' class="btn btn-default bg-info">تحضير الطلب</a>
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
        <!--end: Datatable-->
        </div>
</div>
