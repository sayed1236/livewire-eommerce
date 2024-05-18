<div>
<!-- Modal -->
    <div  class="modal fade" wire:ignore.self  id="rateModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-warning" id="exampleModalLabel">{{ __('ms_lang.show').' :التقييمات' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="card-body col-md-12">
                    <div class="row"  style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable1" style="margin-top: 13px !important">
                            <thead>
                                <tr class="text-center bg-red-400">
                                    <th>{{ __('ms_lang.name_t') }}</th>
                                    <th>{{ __('ms_lang.username') }}</th>
                                    <th>{{ __('ms_lang.rate') }}</th>
                                    <th>{{ __('ms_lang.rated_in') }}</th>
                                    <th>{{ __('ms_lang.rated_app') }}</th>
                                    <th>{{ __('ms_lang.notes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
@if (is_null($rate_results)==0)
    @foreach ($rate_results as $rate_result)
                                <tr>
                                    <td>{{ @$rate_result->user->name}}</td>
                                    <td>{{ @$rate_result->user_rated->name}}</td>
                                    <td>{{ @$rate_result->rate}} <i class="fa fa-star" style="color: gold"></i> </td>
                                    <td>{{ @$rate_result->rated_in->description}}</td>
                                    <td>{{ @$rate_result->rate_app}} <i class="fa fa-star" style="color: gold"></i></td>
                                    <td>{{ @$rate_result->notes}}</td>
                                </tr>
    @endforeach

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
    window.livewire.on('openRatesModal', result_one => {
        $('#rateModal').modal('show');
    });
    window.livewire.on('openRatesModal', () => {
        $('#rateModal').modal('hide');
    });
</script>

@endpush
