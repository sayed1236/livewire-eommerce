<div></div>
{{-- <div  wire:poll.5s>
    <div class="row">
        <div class="col-xl-12 pb-5" >
            اخر وقت للتحديث: {{ now() }}
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">
            <!--begin::Stats Widget 29-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b bg-red-500" >
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users_questions/0/0/open') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-info">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                        <i class="fa fa-question"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                        {{ $open_questions }}
                    </span>
                    <span class="font-weight-bold text-muted font-size-sm">عدد الاسئله المفتوحه</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 29-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 29-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-color: rgb(21, 255, 0)">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users_questions/0/0/close') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-info">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                        <i class="fa fa-question"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                        {{ $close_questions }}
                    </span>
                    <span class="font-weight-bold text-muted font-size-sm">عدد الاسئله المنتهيه</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 29-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 31-->
            <div class="card card-custom bg-blue-400 card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                        <i class="fa fa-car"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $users_cars }}</span>
                    <span class="font-weight-bold text-white font-size-sm">عدد سيارات العملاء</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 31-->
        </div>
        {{-- <div class="col-xl-2">
            <!--begin::Stats Widget 31-->
            <div class="card card-custom bg-warning  card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                        <i class="fa fa-car"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $fanni_cars }}</span>
                    <span class="font-weight-bold text-white font-size-sm">عدد سيارات الفنيين</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 31-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/1') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $members }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الاعضاء</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-blue-400 card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/1?mem_status=under-register') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $members_under_register }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الاعضاء الجاري تسجيلهم</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom card-stretch gutter-b bg-yellow-700">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/1?new=change-member-plan') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $members_change_type }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> طلبات تغيير العضويه</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom  card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-color: rgb(212, 0, 255)">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/3') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $workshops }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الورش</span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom  card-stretch gutter-b bg-blue-500">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/2') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $technision }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الفنيين</span>
                </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-gray-600 card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/2?is_open_notifications=y') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $users_active }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الفنيين المفعلين التنبيه </span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-gray-800 card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/2?is_connect=y') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $users_connect }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الفنيين المفعلين الطلبات </span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-gray-400 card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="{{ url(config('app.url_admin').'users/0/2?is_connect=n') }}" class="">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $users_not_connect }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> الفنيين الغير مفعلين الطلبات </span>
                    </a>
                </div>
                <!--end::Body-->
            </div>
        </div>
            <!--end::Stats Widget 30-->

        {{-- <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom  card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-color: rgba(0, 110, 255, 0.719)">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $admins }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm"> Admin's</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div> --}}

        {{-- <div class="col-xl-2">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">
                        {{ $inbox_messages }}
                    </span>
                    <span class="font-weight-bold text-white font-size-sm">inbox messages</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>

        <div class="col-xl-2">
            <!--begin::Stats Widget 32-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block">
                        {{ $roles }}</span>
                    <span class="font-weight-bold text-white font-size-sm">groups</span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 32-->
        </div>


    </div>

    <!--end::Row-->
    <!--begin::Row-->
    <?php /*<div class="row">

        <div class="col-lg-12">
            <!--begin::Advance Table Widget 4-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Agents Stats</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-info font-weight-bolder font-size-sm mr-3">New Report</a>
                        <a href="#" class="btn btn-danger font-weight-bolder font-size-sm">Create</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <div class="tab-content">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead>
                                    <tr class="text-left text-uppercase">
                                        <th style="min-width: 250px" class="pl-7">
                                            <span class="text-dark-75">products</span>
                                        </th>
                                        <th style="min-width: 100px">earnings</th>
                                        <th style="min-width: 80px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0 py-0">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <img src="media/svg/avatars/014-girl-7.svg" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                                <div>
                                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Natali Trump</a>
                                                    <span class="text-muted font-weight-bold d-block">Python, PostgreSQL, ReactJS</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left pr-0">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">$2,600,000</span>
                                            <span class="text-muted font-weight-bold">Paid</span>
                                        </td>

                                        <td class="pr-0 text-right">
                                            <a href="#" class="btn btn-light-success font-weight-bolder font-size-sm" style="width: 7rem">View Offer</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 4-->
        </div>
    </div>*/ ?>
    <!--end::Row-->
    <!--end::Dashboard-->

    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">احصائيات المناطق </span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">عدد الاسئله لكل منطقه</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <div class="tab-content">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-left text-uppercase">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">المنطقة</span>
                                </th>
                                <th style="min-width: 100px">عدد الاسئله</th>
                                <th style="min-width: 80px"></th>
                            </tr>
                        </thead>
                        <tbody>
@if (isset($gt_cities_questions))
    @foreach ($gt_cities_questions as $gt_cities_question)


                            <tr>
                                <td class="pl-0 py-0">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a  class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                {{ $gt_cities_question->city_id ==0 ?'جميع المناطق' : @$gt_cities_question->city->name  }}
                                            </a>
                                            <span class="text-muted font-weight-bold d-block">{{ @$gt_cities_question->city->name_en }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-left pr-0">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $gt_cities_question->city_count }}</span>
                                </td>
                                <td class="pr-0 text-right">
                                    <a href="{{ url(config('app.url_admin').'users_questions/0/0/all?city_id='.$gt_cities_question->city_id) }}" class="btn btn-light-success font-weight-bolder font-size-sm" style="width: 7rem">عرض</a>
                                </td>
                            </tr>
    @endforeach
@else
@endif
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>
</div> --}}
