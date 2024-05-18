<div>
<!-- Modal -->
    <div  class="modal fade" wire:ignore.self  id="recordsModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center bg-success" id="exampleModalLabel">{{ @$result_one->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="card-body col-md-12">
                    <div class="row"  style="overflow-x: auto;">
@if(is_null($result_one) == 0)
@include('includes.messages')
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable1" style="margin-top: 13px !important">
                            <thead>
                                <tr class="text-center bg-info">
                                    <th>{{ trans('ms_lang.details_t') }}</th>
                                    <th>{{ trans('ms_lang.username') }}</th>
                                    <th>{{ trans('ms_lang.img_t') }}</th>
                                    <th>{{ trans('ms_lang.car') }}</th>
                                    <th>{{ trans('ms_lang.manufacturing_year') }}</th>
                                    <th>{{ trans('ms_lang.audio_file') }}</th>
                                    <th>{{ trans('ms_lang.city') }}</th>
                                    <th>{{ __('ms_lang.date_add') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $result_one->description}}</td>
                                    <td>{{ Auth::user()->user_lang=='ar' ? @$result_one->user->name : @$result_one->user->name_en }}</td>
                                    <td>
                                        @if (is_null($photos) == 0)
                                            @foreach ($photos as $photo)
                                                @if(!empty($photo))
                                                    <img src="{{ img_chk_exist($photo) }}" style="width: 70px; height: 60px;padding-left:3px" />
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ Auth::user()->user_lang=='ar' ? @$result_one->user_car->car->name : @$result_one->user_car->car->name_en }}</td>
                                    <td>{!! $result_one->manufacturing_year !!}</td>
                                    <td>@if(!empty($result_one->audio_file))<a href="{!! img_chk_exist('medias/'.$result_one->audio_file) !!}" target="_blank">{{ __('ms_lang.view') }}</a> @endif</td>
                                    <td>{{ Auth::user()->user_lang=='ar' ? @$result_one->city->name : @$result_one->city->name_en }}</td>
                                    <td>{{ @$result_one->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable1" style="margin-top: 13px !important">
                            <thead>
                                <tr class="text-center bg-info">
                                    <th>#</th>
                                    <th>{{ __('ms_lang.username') }}</th>
                                    <th>{{ __('ms_lang.is_approved') }}</th>
                                    <th>{{ __('ms_lang.status') }}</th>
                                    <th>{{ __('ms_lang.last_update') }}</th>
                                    <th>{{ __('ms_lang.action_t') }}</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(count($result_one->questions_send_requests_all)):
        foreach ($result_one->questions_send_requests_all as $questions_send_requests):
?>
                                <tr>
                                    <td>{{ $i}}</td>
                                    <td>{{ Auth::user()->user_lang=='ar' ? @$questions_send_requests->user->name : @$questions_send_requests->user->name_en }}</td>
                                    <td>
                                        @if($questions_send_requests->is_approved == 'A')
                                            <strong class=" text-success"> {{ trans('ms_lang.accept') }}</strong>
                                        @elseif ($questions_send_requests->is_approved == 'NA')
                                            <strong class="text-danger"> {{ trans('ms_lang.refuse') }}</strong>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($questions_send_requests->status == 'not-submitted')
                                            {{ Auth::user()->user_lang=='ar' ? 'لم يتم التقديم' : 'not-submitted' }}
                                        @elseif ($questions_send_requests->status == 'submitted-another')
                                            <strong class=" text-warning">{{ Auth::user()->user_lang=='ar' ? 'تم التقديم' : 'submitted-another' }}</strong>
                                        @else
                                            {{ @$questions_send_requests->status}}
                                        @endif
                                    </td>
                                    <td>{{ @$questions_send_requests->updated_at}}</td>
                                    <td style="padding: 0px;width: 16%;">
                                        <!---------- active & Dis active Button --->
                                        {{-- {!! add_btn_active('javascript:void(0);',' wire:click="active_ms_stock('.$questions_send_requests->id.')"',$questions_send_requests->is_active) !!} --}}
                            @if ($questions_send_requests->is_approved == 'Y' || $questions_send_requests->status =='close')

                            @else
                                        {!! add_btn_delete('javascript:void(0);',' wire:click="delete_ms_request('.$questions_send_requests->id.')"') !!}
                            @endif
                                    </td>
                                </tr>
<?php
    $i++;
        endforeach;
    endif;
?>
                            </tbody>
                        </table>
@endif
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')

<script type="text/javascript">
    window.livewire.on('openRecordsModal', result_one => {
        $('#recordsModal').modal('show');
    });
    window.livewire.on('closeRecordsModal', () => {
        $('#recordsModal').modal('hide');
    });
</script>

@endpush
