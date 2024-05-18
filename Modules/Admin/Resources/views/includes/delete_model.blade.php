<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('ms_lang.btn_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div data-scroll="true" data-height="300" >
                    <h1 class="text-center text-7xl important">{{ __('ms_lang.r_u_sure_delete') }}</h1>
                </div>
                <div class="modal-footer text-center">
                    <button type="button"  wire:click='delete_ms' class="btn btn-primary font-weight-bold">{{ __('ms_lang.btn_delete') }}</button>
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('ms_lang.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script type="text/javascript">
    window.livewire.on('openDeleteModel',id => {
        console.log(id);
        $('#deleteModel').modal('show');
    });
    window.livewire.on('closeDeleteModel',()=> {
        $('#deleteModel').modal('hide');
    });
</script>

@endpush
