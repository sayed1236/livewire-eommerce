<div>
<!-- Modal -->
    <div  class="modal fade" wire:ignore.self  id="recordsModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-warning" id="exampleModalLabel">{{ __('ms_lang.show').' :'.@$result_one->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="card-body col-md-12">
                    <div class="row"  style="overflow-x: auto;">
@if(is_null($result_one) == 0)
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable1" style="margin-top: 13px !important">
                            <thead>
                                <tr class="text-center bg-red-400">
                                    <th>{{ __('ms_lang.img_t') }}</th>
                                    <th colspan="2">{{ __('ms_lang.name_t') }}</th>
                                    <th>{{ __('ms_lang.mobile') }}</th>
                                    <th>{{ __('ms_lang.city') }}</th>
                                    <!--th>{{ __('ms_lang.email') }}</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ img_chk_exist($result_one->profile_photo_path) }}" style="width: 70px; height: 60px" /></td>
                                    <td colspan="2">{{ @$result_one->name}}</td>
                                    <td>{{ @$result_one->mobile}}</td>
                                    <td>{{ @$result_one->user_detail->city->name}}</td>
                                    <!--td>{{ @$result_one->email}}</td-->
                                </tr>
                                <tr class="text-center bg-blue-400">

                                    <th>{{ __('ms_lang.columns_need_approve') }}</th>
                                    <th>{{ __('ms_lang.whatsapp') }}</th>
                                    <th>{{ __('ms_lang.is_open_notifications') }}</th>
                                    <th>{{ __('ms_lang.is_open_requests') }}</th>
                                    <th>{{ __('ms_lang.years_of_experience') }}</th>
                                </tr>
                                <tr>
                                    <td>{{ @$result_one->columns_need_approve}}</td>
                                    <td>{{ @$result_one->user_detail->whatsapp}}</td>
                                    <td>{{ @$result_one->user_detail->is_open_notifications}}</td>
                                    <td>{{ @$result_one->is_connect}}</td>
                                    <td>{{ @$result_one->user_detail->years_of_experience}}</td>
                                </tr>
                                <tr class="text-center  bg-blue-400">
                                    <th colspan="2">{{ __('ms_lang.notes') }}</th>
                                    <th>{{ __('ms_lang.have_workshop') }}</th>
                                    <th colspan="2">{{ __('ms_lang.notes_of_workshop') }}</th>


                                </tr>
    @if(is_null($result_one->user_detail)== 0)
                                <tr>
                                    <td colspan="2">{{ @$result_one->user_detail->notes}}</td>
                                    <td>{{ @$result_one->user_detail->have_workshop}}</td>
                                    <td colspan="2">{{ @$result_one->user_detail->notes_of_workshop}}</td>

                                </tr>
    @endif
                                <tr class="text-center  bg-blue-400">
                                    <th>{{ __('ms_lang.location') }}</th>
                                    <th>{{ __('ms_lang.questions') }}</th>
@if($result_one->role_id > 1)
                                    <th>{{ __('ms_lang.response_questions') }}</th>
@endif
                                    <th colspan="2">{{ __('ms_lang.cars') }}</th>
                                </tr>
                                <tr>
                                    <td>
                                @if(is_null($result_one->user_detail)== 0)
                                        @if($result_one->user_detail->latitude != 0 && $result_one->user_detail->longitude != 0)
                                            {{ @convert_lat_long_to_address(@$result_one->user_detail->latitude,$result_one->user_detail->longitude)}}
                                        @else
                                            {{ __('ms_lang.no_results') }}
                                        @endif
                                @endif
                                    </td>
                                    <td>
                                        {{ $result_one->questions_count }}
                                    </td>
@if($result_one->role_id > 1)
                                    <td>
                                        {{ $result_one->questions_send_request_closed_count }}
                                    </td>
@endif
                                    <td colspan="2">
@if (count($result_one->user_cars))
    @foreach ($result_one->user_cars as $user_car)
                                        {{ @$user_car->car->name}}
                                         @if(!empty($user_car->model_car_id))
                                         <span style="color: @if ($user_car->is_default_car == 'Y') green @endif ;">
                                             - {{ $user_car->car_model->name }} - {{ $user_car->manufacturing_year }}
                                            @if ($user_car->is_default_car == 'Y')
                                               - السياره الرئيسيه
                                            @endif
                                         </span>
                                         @endif
                                         <br/>
    @endforeach
@else

@endif
                                    </td>
                                </tr>
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
