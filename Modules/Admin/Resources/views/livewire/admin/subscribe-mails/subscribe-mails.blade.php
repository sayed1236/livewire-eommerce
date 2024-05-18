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
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('includes.messages')
            </div>
            <script>
                $(function(){
                    $("#checkAll").click(function(){
                        $('input:checkbox').not(this).prop('checked', this.checked);
                    });
                })
            </script>

<?php
$dis_mobile='d-none';

if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('ms_lang.name_t') }}</th>
                <th class="{{ $dis_mobile }}">{{ trans('ms_lang.mobile_t') }}</th>
                <th >{{ trans('ms_lang.email_t') }}</th>
                <th>{{ trans('ms_lang.created_at') }}</th>
                <th> {{ trans('ms_lang.btn_select') }} <br/>
                    ( <input type="checkbox" id="checkAll" class="form-input" value="all" /> تحديد الكل )
                </th>
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
                    <td class="{{ $dis_mobile }}">{{ @$result->mobile }}</td>
                    <td>{{ @$result->email }}</td>
                    <td>{{ @$result->created_at }}</td>
                    <td><input type="checkbox" name="emails" wire:model='emails' class="form-input emails" value="{{ $result->email }}" /></td>
                        <td style="padding: 0px;">
                        <!---------- active & Dis active Button --->
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
        <div class="box box-default">
            <div class="box-header with-border" style="text-align: center;">
            <h4><center><i class="halflings-icon edit"></i><span class="break"></span>ارسال رساله بريديه / Send email</center></h4>
            </div><!-- /.box-header -->
            <center><h3 style="color:green"></h3></center>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="error_sub"> </div>
                        <div class="box box-primary">
                                <form wire:submit.prevent='send_email' method="post">
                                    <div class="form-group">
                                        <label class="control-label" for="fileInput">Subject/موضوع الرسالة</label>
                                        <textarea tabindex="3" wire:model='subject' class="form-control" id="subject" name="subject" rows="1" placeholder="Subject message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fileInput">text message/نص الرسالة</label>
                                        <textarea   rows="2" wire:model='message' name="message" id="message" class="form-control editor1"></textarea>
                                    </div>
                                    <div class="form-actions" style="text-align: center;">
                                        <input type="submit" class="btn btn-success" id="send_mso_mails" name="reply" value="{{ __('ms_lang.btn_send') }}" tabindex="3"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">{{ __('ms_lang.no_results') }}</center></h2>
<?php endif; ?>
        <!--end: Datatable-->
        </div>
@section('footer')
<script>
    window.livewire.on('remove_modal', () => {
       $('#exampleModal').modal('hide');
    });
</script>
@endsection
</div>

