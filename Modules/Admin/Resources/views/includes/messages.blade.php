@if (count($errors) > 0 || Session::has('success_message') || Session::has('error_message') || session('status'))


    @if(count($errors) > 0)
        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10 flash_message">
            <!--begin::Icon-->
            <i class="ki-duotone ki-message-text-2 fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    <!--end::Icon-->

            <!--begin::Content-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
        @foreach ($errors->all() as $error)
                <h4 class="mb-2 text-light"><i class="flaticon-warning"></i> {{ $error}}</h4>
        @endforeach
            </div>
            <!--end::Content-->

            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-2x text-light"></i></button>
            <!--end::Close-->
        </div>
    @endif


@if(Session::has('success_message'))
            <div id="toastr-container" class="alert alert-dismissible  toastr-top-right flash_message">
                <div class="toastr toastr-success" aria-live="polite" style="background-image:unset!important">
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto toastr-close-button" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-light"></i>
                    </button>
                    <div class="toastr-title">{{ __('ms_lang.successfully_added') }}</div>
                    {{-- <div class="toastr-message">{!! session('success_message') !!}</div> --}}
                </div>
            </div>
        {{-- <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;">
            <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-error swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;">
                <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                    <span class="swal2-x-mark">
                        <span class="swal2-x-mark-line-left"></span>
                        <span class="swal2-x-mark-line-right"></span>
                    </span>
                </div> 
                <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                    <div class="swal2-icon-content">!</div>
                </div>
                <div class="swal2-html-container" id="swal2-html-container" >{!! session('success_message') !!} <i class="flaticon-warning"></i></div>
                <div class="swal2-actions" style="display: flex;">
                    <div class="swal2-loader"></div>
                    <button type="button" class="swal2-confirm btn btn-primary" aria-label="" style="display: inline-block;">{{ __('ms_lang.btn_close') }}</button>
                    <button type="button" class="swal2-cancel btn btn-active-light" aria-label="" style="display: inline-block;">No, return</button>
                </div>
            </div>
        </div>--}}
@endif

@if(Session::has('error_message'))
        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10 flash_message">
            <i class="ki-duotone ki-message-text-2 fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <h4 class="mb-2 text-light">{!! session('error_message') !!} <i class="flaticon-warning"></i></h4>
            </div>
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-2x text-light">X</i>
            </button>
        </div>
@endif

@if (session('status'))
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10 flash_message">
        <i class="ki-duotone ki-message-text-2 fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">{!! session('status') !!} <i class="flaticon-warning"></i></h4>
        </div>
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-2x text-light">X</i>
        </button>
    </div>
@endif



<script>
    window.setTimeout(function() {
        $(".flash_message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });

    }, 3000);
</script>


@endif



