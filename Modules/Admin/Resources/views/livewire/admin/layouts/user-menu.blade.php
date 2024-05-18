<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="{{ @$data_kt_menu_placement_bottom }}">
<?php
if(is_file(url('uploads/'.Auth::user()->img))&& file_exists(url('uploads/'.Auth::user()->img)))
{
?>
        <span class="symbol-label fs-4 font-weight-bold text-uppercase" style="background-image:url('<?php echo url('uploads/'.Auth::user()->img); ?>')"></span>
<?php
}else{
?>
		<span class="symbol-label fs-4 font-weight-bold text-uppercase"><?php  echo substr(Auth::user()->name,0,3); ?></span>
<?php } ?>
        {{-- <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">

        </span> --}}
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold"><?php  echo substr(Auth::user()->name,0,1); ?></span>
                    </span>
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}</div>
                    <a class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="{{ url('A_ms_admin/users/profile') }}" class="menu-link px-5">My Profile </a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        {{-- <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            <a href="#" class="menu-link px-5">
                <span class="menu-title">My Subscription</span>
                <span class="menu-arrow"></span>
            </a>
            <!--begin::Menu sub-->
            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content px-3">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                            <span class="form-check-label text-muted fs-7">Notifications</span>
                        </label>
                    </div>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu sub-->
        </div> --}}
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">

@if ($speacial_data->lang=='Y')
        <a href="#" class="menu-link px-5">
            <span class="menu-title position-relative">Language
                <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                    @if(Auth::user()->user_lang == 'ar')
                        العربية
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ url('admin/media/flags/saudi-arabia.svg') }}"  />
                    @else
                        English
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ url('admin/media/flags/united-states.svg') }}" />
                    @endif
                </span>
            </span>
        </a>
        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-dropdown w-175px py-4">
    @if(Auth::user()->user_lang == 'ar')
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ url('locale/en') }}" class="menu-link d-flex px-5 active">
                <span class="symbol symbol-20px me-4">
                    <img class="rounded-1" src="{{ url('admin/media/flags/united-states.svg') }}" alt="" />
                </span>English</a>
            </div>
            <!--end::Menu item-->
    @else
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ url('locale/ar') }}" class="menu-link d-flex px-5">
                <span class="symbol symbol-20px me-4">
                    <img class="rounded-1" src="{{ url('admin/media/flags/saudi-arabia.svg') }}" alt="" />
                </span>العربيه</a>
            </div>
            <!--end::Menu item-->
    @endif
        </div>
            <!--end::Menu-->
@endif

        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        {{-- <div class="menu-item px-5 my-1">
            <a href="../../demo1/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
        </div> --}}
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a class="btn btn-lg btn-light-danger font-weight-bolder py-2 px-5" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div>
