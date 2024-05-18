<div class="modal fade" id="alertModel" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-custom alert-light-danger fade show mb-5" id="flash_message" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $error}}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
    @endforeach
@endif
@if(Session::has('success_message'))
   <div class="alert alert-custom alert-light-success fade show mb-5" id="flash_message" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{!! session('success_message') !!}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('ms_lang.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script type="text/javascript">
    window.livewire.on('openAlertModal',id => {
        console.log(id);
        $('#alertModel').modal('show');
    });
    window.livewire.on('closeAlertModel',()=> {
        $('#alertModel').modal('hide');
    });
</script>

@endpush
