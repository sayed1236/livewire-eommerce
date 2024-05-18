<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Header Menu Wrapper-->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<!--begin::Header Menu-->
								<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
									<!--begin::Header Nav-->
									<ul class="menu-nav">
										<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active" data-menu-toggle="click" aria-haspopup="true">
											<a  class="menu-link">
                                                <i class="icon-1x text-dark-50 ki ki-bold-double-arrow-next"></i><span class="menu-text">&nbsp;{{ @$title_page }}</span>
											</a>
                                        </li>

									</ul>
									<!--end::Header Nav-->
								</div>
								<!--end::Header Menu-->
							</div>
							<!--end::Header Menu Wrapper-->
							<!--begin::Topbar-->
							<div class="topbar">

								<!--begin::Languages-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" >
										<a href="{{ url('./') }}" target="_blank" class="">
                                            <div class="btn  btn-default text-info  btn-lg mr-1">
                                            {{ __('ms_lang.go2site') }} <i class="fa fa-arrow-right"></i>
										</div>
                                    </a>
									</div>
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                            @if(Auth::user()->user_lang == 'ar')
                                            <img class="h-20px w-20px rounded-sm" src="{{ url('admin/media/svg/flags/008-saudi-arabia.svg') }}"  />
                                            @else
                                            <img class="h-20px w-20px rounded-sm" src="{{ url('admin/media/svg/flags/226-united-states.svg') }}" />
                                            @endif
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
											<!--begin::Nav-->
											<ul class="navi navi-hover py-4">
												<!--begin::Item-->
												<li class="navi-item">
													@if(Auth::user()->user_lang == 'ar')
													<a href="{{ url('locale/en') }}" class="navi-link">
														<span class="symbol symbol-20 mr-3">
															<img src="{{ url('admin/media/svg/flags/226-united-states.svg') }}" alt="" />
														</span>
														<span class="navi-text">English</span>
													</a>
													@else
													<a href="{{ url('locale/ar') }}" class="navi-link">
														<span class="symbol symbol-20 mr-3">
															<img src="{{ url('admin/media/svg/flags/008-saudi-arabia.svg') }}" alt="" />
														</span>
														<span class="navi-text">العربيه</span>
													</a>
													@endif
												</li>
												<!--end::Item-->

											</ul>
											<!--end::Nav-->
										</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Languages-->
								<!--begin::User-->
								<div class="topbar-item">
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">

										<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold"><?php  echo substr(Auth::user()->name,0,1); ?></span>
										</span>
									</div>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<div class="d-flex flex-column-fluid">
					<!--begin::Card-->
						<div class="container">

