<!DOCTYPE html>
<html>
<head lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(Auth::user()->user_lang == 'ar') direction="rtl" dir="rtl" style="direction: rtl" @endif>
    @include('admin::admin.layouts.head')
    <?php
    /* /////////////////------->powered BY: ENG \ Mohamed saeed ali    <---------------\\\\\\\\\\\\\\\\\\\\\
    * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
    * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
    /*
    @guest
    <script>
    window.Location('<?php echo route('admin.login'); ?>');
    </script>
    @endguest
    */
    ?>
    <livewire:styles />
</head>
<!--begin::Body-->
<body id="kt_app_body" @if(Auth::user()->user_lang == 'ar') dir="rtl" style="direction:rtl" @endif data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
<livewire:admin::admin.layouts.header />
@yield('header')
{{-- @include('admin.layouts.header_mnu') --}}

{{-- @include('admin.layouts.sidebar') --}}

                <!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                        <!--begin::Logo-->
						<div class="app-sidebar-logo px-6 bg-white" id="kt_app_sidebar_logo">
							<!--begin::Logo image-->
                            <a href="{{ url(config('app.url_admin')) }}"  class="brand-logo text-center">
                                <img src="{{ url('uploads/logo.png') }}" class="h-25px app-sidebar-logo-default" style="max-height:50px;max-width:130px" />
                                <img src="{{ url('uploads/thumbnail/logo.png') }}" class="h-20px app-sidebar-logo-minimize" style="max-height:50px;max-width:130px" />
                            </a>
							<!--end::Logo image-->
							<!--begin::Sidebar toggle-->
							<!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") { 
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
							<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
								<i class="ki-duotone ki-black-left-line fs-3 rotate-180">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</div>
							<!--end::Sidebar toggle-->
						</div>
						<!--end::Logo-->
						<!--begin::sidebar menu-->

<livewire:admin::admin.layouts.sidebar />
            
                    </div>
                    <!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid" style="min-height: 500px">
@yield('content')

<!--begin::Footer-->
                        </div>
						<div id="kt_app_footer" class="app-footer">
							<!--begin::Footer container-->
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<!--begin::Copyright-->
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2023&copy;</span>
                                    <a href="https://pure-soft.com" target="_blank" class="text-gray-800 text-hover-success">Puresoft Co.</a>
								</div>
								<!--end::Copyright-->
							</div>
							<!--end::Footer container-->
						</div>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>

{{-- @include('admin::admin.layouts.user_mnus')--}}
<livewire:admin::admin.layouts.footer />
@stack('scripts')
<livewire:scripts />


{{-- @include('admin::admin/layouts/footer') --}}
@yield('footer')
</body>
</html>
