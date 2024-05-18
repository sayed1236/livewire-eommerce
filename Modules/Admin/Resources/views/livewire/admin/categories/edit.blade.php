<div id="kt_app_content_container" class="app-container  container-xxl border-yellow">
@if ($showForm == true)
    <?php
    $dis_cat = 'd-none';
    $dis_det = 'd-none';
    $dis_img = '';
    $img_type = '';
    $lang_en = '';
    $dis_img_nave = '';
    $seo = '';
    if (isset($category_id) && $category_id != 0) {
        $dis_cat = '';
    }
    if ($parent_id != 0) {
        $dis_img_nave = 'd-none';
    }
    if ($type == 1) {
        $dis_det = '';
    }
    if ($special_data->lang == 'N') {
        $lang_en = 'd-none';
    }
    if ($special_data->seo == 2) {
        $seo = 'd-none';
    }
    
    ?>

    {!! html()->form('POST', '')->attributes(['enctype' => 'multipart/form-data', 'wire:submit.prevent' => 'store_update'])->open() !!}
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid mb-8 mb-lg-0 me-lg-7 me-xl-8">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body p-12">
                        <div class="fv-row mb-9 fv-plugins-icon-container row">

                            @isset($edit_object['img'])
                                <div class="fv-row mb-9 fv-plugins-icon-container">
                                    <label for="ord">{{ __('ms_lang.img_t') }}</label>
                                    <img src="{{ img_chk_exist($edit_object['img']) }}" style="width: 70px; height: 60px" />
                                </div>
                            @endisset
                        </div>
                        <div class="fv-row mb-9 fv-plugins-icon-container row">
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-10">
                                {!! html()->label(__('ms_lang.name_t'))->for('name') !!}
                                {!! html()->text('name')->attributes(['wire:model' => 'name', 'class' => 'form-control form-control-solid']) !!}
                                {!! html()->hidden('type')->attributes(['wire:model' => 'type']) !!}
                                {!! html()->hidden('parent_id')->attributes(['wire:model' => 'parent_id']) !!}
                                <div>
                                    @error('name')
                                        <span class="error text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="fv-row mb-9 fv-plugins-icon-container col-2">
                                {!! html()->label(__('ms_lang.ord_t')) !!}
                                {!! html()->number('ord')->attributes(['wire:model' => 'ord', 'class' => 'form-control form-control-solid', 'min' => 0]) !!}
                            </div>
                            {{--  <?php $select_arr = [0 => __('ms_lang.select')]; ?>
                        @foreach (__('ms_lang.choose_viewd') as $key => $value)
                            <?php $select_arr[$key] = $value; ?>
                        @endforeach  --}}
                            {{--  <div class="fv-row mb-9 fv-plugins-icon-container col-md-8">
                            {!! html()->label('choose_viewd', __('ms_lang.ask_view'), []) !!}
                            {!! html()->select('choose_viewd',@$select_arr, '', ['wire:model'=>'choose_viewd','class'=>"form-control form-control-solid"]) !!}
                        </div>  --}}
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-6 {{ $dis_img }}">
                                {!! html()->label(__('ms_lang.img_t')) !!}
                                @if ($img_type == 'icon')
                                    {!! html()->text('img_icon')->attributes(['wire:model' => 'img_icon', 'class' => 'form-control form-control-solid']) !!}
                                    {!! html()->hidden('img_type')->attributes(['wire:model.defer' => 'img_type']) !!}
                                @else
                                    {!! html()->file('img')->attributes(['wire:model' => 'img', 'class' => 'form-control form-control-solid']) !!}
                                @endif
                            </div>
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-6 {{ $dis_img_nave }}">
                                {!! html()->label(__('ms_lang.img_nav_t')) !!}
                                {!! html()->file('img')->attributes(['wire:model' => 'img_nave', 'class' => 'form-control form-control-solid']) !!}
                            </div>
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-12 {{ $dis_det }}">
                                {!! html()->label(__('ms_lang.details_t')) !!}
                                {!! html()->textarea('details')->attributes([
                                        'wire:model' => 'details',
                                        'class' => 'form-control form-control-solid editor1',
                                        'dir' => 'rtl',
                                        'rows' => '3',
                                    ]) !!}
                            </div>
                            {{-- <div class="fv-row mb-9 fv-plugins-icon-container col-md-12 {{ $dis_det }} {{ $lang_en }}">
                            <label for="details_en"> </label>
                            {!! html()->label(__('ms_lang.details_en_t')) !!}
                            {!! html()->textarea('details_en')->attributes(['wire:model'=>'details_en','class'=>"form-control form-control-solid editor1",'rows'=>"3"]) !!}
                        </div> --}}
                            <div class="fv-row mb-9 fv-plugins-icon-container {{ $seo }}">
                                <h3>seo :- </h3><br>
                            </div>
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-12 {{ $seo }}">
                                {!! html()->label(__('ms_lang.keywords')) !!}
                                {!! html()->text('keywords')->attributes(['wire:model' => 'keywords', 'class' => 'form-control form-control-solid']) !!}
                            </div>
                            <div class="fv-row mb-9 fv-plugins-icon-container col-md-12 {{ $seo }} ">
                                {!! html()->label(__('ms_lang.details_t')) !!}
                                {!! html()->textarea('details_seo')->attributes([
                                        'wire:model' => 'details_seo',
                                        'class' => 'form-control form-control-solid editor1',
                                        'dir' => 'rtl',
                                        'rows' => '3',
                                    ]) !!}
                            </div>
            
                        </div>
                        <div class="box-footer">
                            {!! html()->submit(__('ms_lang.btn_save'))->attributes(['class' => 'btn btn-info pull-center']) !!}
                            <button type="reset" class="btn btn-default">{{ __('ms_lang.btn_reset') }}</button>
                        </div>
                        <!--begin::Form-->
                        {{-- <form action="" id="kt_invoice_form">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start flex-xxl-row">


                              
                            </div>
                        </form> --}}
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->




            <div class="col-xl-4 d-none">
                <!--begin::Contacts-->
                <div class="card card-flush h-lg-100" id="kt_contacts_main">
                    <!--begin::Card header-->
                    <div class="card-header pt-7" id="kt_chat_contacts_header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <i class="ki-duotone ki-badge fs-1 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i><h2>SEO Details</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5">
                        <!--begin::Form-->
                        <form id="kt_ecommerce_settings_general_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold mb-3">
                                    <span>Update Avatar</span>
                
                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="Allowed file types: png, jpg, jpeg." data-bs-original-title="Allowed file types: png, jpg, jpeg." data-kt-initialized="1">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    </span>
                                </label>
                                <!--end::Label-->
                
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty " data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-100px h-100px" style="background-image: url('')"></div>
                                        <!--end::Preview existing avatar-->
                
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                        </span>
                                        <!--end::Cancel-->
                
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span>Notes</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enter any additional notes about the contact (optional)." data-bs-original-title="Enter any additional notes about the contact (optional)." data-kt-initialized="1">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    </span>
                                </label>
                                <!--end::Label-->
                
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid" name="notes"></textarea>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                
                            <!--begin::Action buttons-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">
                                    Cancel
                                </button>
                                <!--end::Button-->
                
                                <!--begin::Button-->
                                <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Save
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Action buttons-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Contacts-->
            </div>

        </div>
    <!--end::Layout-->
    {!! html()->form()->close() !!}
@endif
</div>
