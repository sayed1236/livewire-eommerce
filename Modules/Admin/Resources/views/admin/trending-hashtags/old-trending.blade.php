<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label">{{ $title_page }}

			<div class="text-muted pt-2 font-size-sm">


			</div></h3>
        </div>

		<div class="card-toolbar">
            <!--begin::Button-->

			<a href="{{ url(config('app.url_admin').'trending-hashtags') }}"  class="btn btn-primary font-weight-bolder">
			  <span class="svg-icon svg-icon-md"> <i class="icon-xl fas fa-list text-success"></i>{!! trans('ms_lang.btn_view_new') !!}
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
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>Keyword</th>
                <th>promoted_content</th>
                <th>query</th>
                <th>tweet_volume</th>
                <th>Action/الاجراء</th>
              </tr>
            </thead>
            <tbody>
<?php
    $i=1;
    foreach ($results as $result):
?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class="text-primery" dir="ltr"><a href="{{ @$result->url }}" target="_blank">{{ @substr($result->name,0,1)=='#' ? $result['name'] : '#'.$result['name'] }}</a></td>
                    <td class="text-primery" dir="ltr">{{ @$result->promoted_content }}</td>
                    <td class="text-primery" dir="ltr">{{ @$result->query }}</td>
                    <td class="text-primery" dir="ltr">{{ @$result->tweet_volume }}</td>
                    <td style="padding: 0px;width: 15%;">
                        <!---------- active & Dis active Button --->
                        {{-- {!! add_btn_active('javascript:void(0);',' wire:click="active_ms('.$result->id.')"',$result->is_active) !!}
                        {!! add_btn_edit('javascript:void(0);',' wire:click="edit_form('.$result->id.')"') !!}
                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms('.$result->id.')"',$result->is_active) !!} --}}
                    </td>
                </tr>
<?php $i++;
    endforeach;
?>
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

        </div>
</div>

